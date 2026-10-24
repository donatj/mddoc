<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Exceptions\ClassNotReadableException;
use donatj\MDDoc\Reflectors\Source\Argument;
use donatj\MDDoc\Reflectors\Source\ClassDefinition;
use donatj\MDDoc\Reflectors\Source\DocBlock;
use donatj\MDDoc\Reflectors\Source\DocBlockParser;
use donatj\MDDoc\Reflectors\Source\Element;
use PhpParser\Node;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassConst;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Enum_;
use PhpParser\Node\Stmt\EnumCase;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Stmt\GroupUse;
use PhpParser\Node\Stmt\Interface_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\Trait_;
use PhpParser\Node\Stmt\TraitUse;
use PhpParser\Node\Stmt\Use_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;

class TaxonomyReflector {

	private AutoloaderInterface $autoLoader;
	private TaxonomyReflectorFactory $parserFactory;

	/** @var array<string,ClassDefinition> */
	private array $classes;

	/** @var array<string,Element> */
	private array $functions;

	private DocBlockParser $docBlockParser;
	private ?DocBlock $fileDocBlock;
	private Standard $prettyPrinter;

	/**
	 * @throws ClassNotReadableException
	 */
	public function __construct(
		string $filename,
		AutoloaderInterface $autoLoader,
		TaxonomyReflectorFactory $parserFactory
	) {
		$this->autoLoader     = $autoLoader;
		$this->parserFactory  = $parserFactory;
		$this->docBlockParser = new DocBlockParser;
		$this->prettyPrinter  = new Standard;

		$source = @file_get_contents($filename);
		if( $source === false ) {
			throw new ClassNotReadableException('failed to read class file', $filename);
		}

		$this->fileDocBlock = $this->docBlockParser->parse(self::getFileDocComment($source));

		try {
			$parser = (new ParserFactory)->createForNewestSupportedVersion();
			$nodes  = $parser->parse($source);

			$traverser = new NodeTraverser;
			$traverser->addVisitor(new NameResolver);
			$nodes = $traverser->traverse($nodes ?? []);
		} catch( \Exception $ex ) {
			throw new ClassNotReadableException('failed to read class file', $filename, $ex);
		}

		$declarations    = $this->collectStatements($nodes, '', $this->importsFromNodes($nodes));
		$this->functions = $declarations['functions'];
		$this->classes   = $declarations['classes'];
	}

	/**
	 * @param Node[] $nodes
	 * @param array<string,string> $imports
	 * @return array{functions:array<string,Element>,classes:array<string,ClassDefinition>}
	 */
	private function collectStatements( array $nodes, string $namespace = '', array $imports = [] ) : array {
		$functions = [];
		$classes   = [];

		foreach( $nodes as $node ) {
			$declarations = $this->collectNode($node, $namespace, $imports);
			$functions    = array_merge($functions, $declarations['functions']);
			$classes      = array_merge($classes, $declarations['classes']);
		}

		return [ 'functions' => $functions, 'classes' => $classes ];
	}

	/**
	 * @param array<string,string> $imports
	 * @return array{functions:array<string,Element>,classes:array<string,ClassDefinition>}
	 */
	private function collectNode( Node $node, string $namespace, array $imports ) : array {
		if( $node instanceof Namespace_ ) {
			return $this->collectStatements($node->stmts, $node->name === null ? '' : $node->name->toString(), $this->importsFromNodes($node->stmts));
		}

		$functions = [];
		$classes   = [];

		if( $node instanceof Function_ ) {
			$function                            = $this->elementFromFunction($node, $namespace, $imports);
			$functions[$function->getName()] = $function;
		} elseif( ($node instanceof Class_ && $node->name !== null) || $node instanceof Enum_ || $node instanceof Interface_ || $node instanceof Trait_ ) {
			$class = $this->classDefinitionFromNode($node, $namespace, $imports);
			$classes[$class->getReflector()->getFqsen()] = $class;
		}

		foreach( $node->getSubNodeNames() as $subNodeName ) {
			$subNode = $node->$subNodeName;
			if( $subNode instanceof Node ) {
				$declarations = $this->collectNode($subNode, $namespace, $imports);
				$functions    = array_merge($functions, $declarations['functions']);
				$classes      = array_merge($classes, $declarations['classes']);
			} elseif( is_array($subNode) ) {
				foreach( $subNode as $childNode ) {
					if( $childNode instanceof Node ) {
						$declarations = $this->collectNode($childNode, $namespace, $imports);
						$functions    = array_merge($functions, $declarations['functions']);
						$classes      = array_merge($classes, $declarations['classes']);
					}
				}
			}
		}

		return [ 'functions' => $functions, 'classes' => $classes ];
	}

	/**
	 * @param Class_|Enum_|Interface_|Trait_ $node
	 * @param array<string,string> $imports
	 */
	private function classDefinitionFromNode( Node $node, string $namespace, array $imports ) : ClassDefinition {
		$classDocBlock = $this->docBlockParser->parse($this->getDocComment($node), $namespace, $imports);
		$reflector = new Element(
			$node->name === null ? '' : $node->name->toString(),
			$this->getNamespacedName($node),
			$classDocBlock,
			'public',
			false,
			[],
			'mixed',
			null,
			$node instanceof Enum_ ? 'enum' : 'class',
			$node instanceof Enum_ && $node->scalarType !== null ? $this->typeFromNode($node->scalarType) : null
		);
		$class     = new ClassDefinition($reflector);
		$typeNames = $classDocBlock === null ? [] : $classDocBlock->getTypeNames();

		if( $docBlock = $reflector->getDocBlock() ) {
			foreach( $docBlock->getTagsByName('method') as $docMethod ) {
				$class = $class->withDocMethod($docMethod);
			}
		}

		foreach( $node->stmts as $statement ) {
			if( $statement instanceof ClassMethod ) {
				$method = $this->elementFromMethod($statement, $reflector->getFqsen(), $namespace, $imports, $typeNames);
				$class = $class->withMethod($method);

				if( $method->getName() === '__construct' ) {
					$class = $this->withPromotedProperties($statement, $reflector, $class);
				}
			} elseif( $statement instanceof ClassConst && !($node instanceof Trait_) ) {
				foreach( $statement->consts as $const ) {
					$constant = new Element(
						$const->name->toString(),
						$reflector->getFqsen() . '::' . $const->name->toString(),
						$this->docBlockParser->parse($this->getDocComment($statement), $namespace, $imports, $typeNames),
						$this->visibility($statement),
						false,
						[],
						'mixed',
						$this->prettyPrinter->prettyPrintExpr($const->value)
					);
					$class = $class->withConstant($constant);
				}
			} elseif( $statement instanceof EnumCase ) {
				$enumCase = new Element(
					$statement->name->toString(),
					$reflector->getFqsen() . '::' . $statement->name->toString(),
					$this->docBlockParser->parse($this->getDocComment($statement), $namespace, $imports, $typeNames),
					'public',
					false,
					[],
					'mixed',
					$statement->expr === null ? null : $this->prettyPrinter->prettyPrintExpr($statement->expr),
					'class',
					null,
					true
				);
				$class = $class->withConstant($enumCase);
			} elseif( $statement instanceof Property ) {
				foreach( $statement->props as $property ) {
					$default = $property->default === null ? null : $this->prettyPrinter->prettyPrintExpr($property->default);
					$sourceProperty = new Element(
						$property->name->toString(),
						$reflector->getFqsen() . '::$' . $property->name->toString(),
						$this->docBlockParser->parse($this->getDocComment($statement), $namespace, $imports, $typeNames),
						$this->visibility($statement),
						$statement->isStatic(),
						[],
						'mixed',
						$default
					);
					$class = $class->withProperty($sourceProperty);
				}
			}
		}

		if( $node instanceof Class_ && $node->extends !== null ) {
			$class = $class->withDependency($this->getClassReference($node->extends, $namespace));
		}

		if( $node instanceof Class_ || $node instanceof Enum_ || $node instanceof Trait_ ) {
			foreach( $node->stmts as $statement ) {
				if( $statement instanceof TraitUse ) {
					foreach( $statement->traits as $trait ) {
						$class = $class->withDependency($this->getClassReference($trait, $namespace));
					}
				}
			}
		}

		if( $node instanceof Interface_ ) {
			foreach( $node->extends as $interface ) {
				$class = $class->withDependency($this->getClassReference($interface, $namespace));
			}
		}

		if( $node instanceof Class_ || $node instanceof Enum_ ) {
			foreach( $node->implements as $interface ) {
				$class = $class->withDependency($this->getClassReference($interface, $namespace));
			}
		}

		return $class;
	}

	private function withPromotedProperties( ClassMethod $method, Element $class, ClassDefinition $definition ) : ClassDefinition {
		foreach( $method->params as $param ) {
			if( $param->flags === 0 ) {
				continue;
			}

			$default = $param->default === null ? null : $this->prettyPrinter->prettyPrintExpr($param->default);
			$property = new Element(
				$param->var->name,
				$class->getFqsen() . '::$' . $param->var->name,
				null,
				$this->visibilityFromFlags($param->flags),
				($param->flags & Class_::MODIFIER_STATIC) !== 0,
				[],
				'mixed',
				$default
			);

			$definition = $definition->withProperty($property);
		}

		return $definition;
	}

	/**
	 * @param array<string,ClassDefinition> $classes
	 * @return array<string,ClassDefinition>
	 */
	private function resolveClassDefinitions( array $classes ) : array {
		$resolved = [];

		foreach( $classes as $class ) {
			$resolution = $this->resolveClassDependencies($class, $classes, $resolved, []);
			$resolved   = $resolution['resolved'];
		}

		return array_replace($classes, $resolved);
	}

	/** @mddoc-ignore */
	public function withResolvedDependencies() : self {
		$reflector = clone $this;
		$reflector->classes = $this->resolveClassDefinitions($this->classes);

		return $reflector;
	}

	/**
	 * @param array<string,ClassDefinition> $classes
	 * @param array<string,ClassDefinition> $resolved
	 * @param array<string,true> $resolving
	 * @return array{class:ClassDefinition,resolved:array<string,ClassDefinition>}
	 */
	private function resolveClassDependencies(
		ClassDefinition $class,
		array $classes,
		array $resolved,
		array $resolving
	) : array {
		$name = $class->getReflector()->getFqsen();
		if( isset($resolved[$name]) ) {
			return [ 'class' => $resolved[$name], 'resolved' => $resolved ];
		}

		if( isset($resolving[$name]) ) {
			return [ 'class' => $class, 'resolved' => $resolved ];
		}

		$resolving = $resolving + [ $name => true ];
		foreach( $class->getDependencies() as $dependencyName ) {
			$dependency = $this->findClass($classes, $dependencyName);
			if( $dependency !== null ) {
				$resolution = $this->resolveClassDependencies($dependency, $classes, $resolved, $resolving);
				$dependency = $resolution['class'];
				$resolved   = $resolution['resolved'];
			} else {
				$filename = ($this->autoLoader)($dependencyName);
				if( $filename !== null && is_readable($filename) ) {
					$dependency = $this->parserFactory->newInstance($filename, $this->autoLoader)->getClass($dependencyName);
				}
			}

			if( $dependency !== null ) {
				$class = $class->withMergedDependency($dependency);
			}
		}

		return [
			'class'    => $class,
			'resolved' => $resolved + [ $name => $class ],
		];
	}

	private function getClassReference( Name $name, string $namespace ) : string {
		if( $name instanceof FullyQualified ) {
			return '\\' . $name->toString();
		}

		$namespacedName = $name->getAttribute('namespacedName');
		if( $namespacedName instanceof Name ) {
			return '\\' . $namespacedName->toString();
		}

		return '\\' . ($namespace === '' ? '' : $namespace . '\\') . $name->toString();
	}

	/** @param array<string,string> $imports */
	private function elementFromFunction( Function_ $node, string $namespace, array $imports ) : Element {
		$name = $node->name->toString();

		return new Element(
			$name,
			$this->getNamespacedName($node),
			$this->docBlockParser->parse($this->getDocComment($node), $namespace, $imports),
			'public',
			false,
			$this->argumentsFromNode($node),
			$this->typeFromNode($node->returnType)
		);
	}

	/**
	 * @param array<string,string> $imports
	 * @param array<string,true> $typeNames
	 */
	private function elementFromMethod(
		ClassMethod $node,
		string $className,
		string $namespace,
		array $imports,
		array $typeNames
	) : Element {
		$name = $node->name->toString();

		return new Element(
			$name,
			$className . '::' . $name . '()',
			$this->docBlockParser->parse($this->getDocComment($node), $namespace, $imports, $typeNames),
			$this->visibility($node),
			$node->isStatic(),
			$this->argumentsFromNode($node),
			$this->typeFromNode($node->returnType)
		);
	}

	/**
	 * @param Function_|ClassMethod $node
	 * @return Argument[]
	 */
	private function argumentsFromNode( Node $node ) : array {
		$arguments = [];
		foreach( $node->params as $param ) {
			$arguments[] = new Argument(
				$param->var->name,
				$this->typeFromNode($param->type),
				$param->default === null ? null : $this->prettyPrinter->prettyPrintExpr($param->default),
				$param->variadic
			);
		}

		return $arguments;
	}

	private function getNamespacedName( Node $node ) : string {
		$name = property_exists($node, 'namespacedName') ? $node->namespacedName : null;

		return $name instanceof Name ? '\\' . $name->toString() : '';
	}

	private function getDocComment( Node $node ) : ?string {
		$comment = $node->getDocComment();

		return $comment === null ? null : $comment->getText();
	}

	private static function getFileDocComment( string $source ) : ?string {
		$tokens = token_get_all($source);
		foreach( $tokens as $index => $token ) {
			if( !is_array($token) ) {
				continue;
			}

			if( $token[0] === T_NAMESPACE ) {
				return null;
			}

			if( $token[0] === T_DOC_COMMENT ) {
				foreach( array_slice($tokens, $index + 1) as $next ) {
					if( !is_array($next) ) {
						if( trim($next) === '' ) {
							continue;
						}

						return $token[1];
					}

					if( $next[0] === T_WHITESPACE || $next[0] === T_COMMENT || $next[0] === T_ABSTRACT || $next[0] === T_FINAL ) {
						continue;
					}

					if(
						$next[0] === T_CLASS
						|| $next[0] === T_INTERFACE
						|| $next[0] === T_TRAIT
						|| $next[0] === T_FUNCTION
						|| (defined('T_ENUM') && $next[0] === constant('T_ENUM'))
						|| ($next[0] === T_STRING && strtolower($next[1]) === 'enum')
					) {
						return null;
					}

					return $token[1];
				}

				return $token[1];
			}
		}

		return null;
	}

	/**
	 * @param Node[] $nodes
	 * @return array<string,string>
	 */
	private function importsFromNodes( array $nodes ) : array {
		$imports = [];
		foreach( $nodes as $node ) {
			if( $node instanceof Use_ && $node->type === Use_::TYPE_NORMAL ) {
				foreach( $node->uses as $use ) {
					$imports[strtolower($use->getAlias()->toString())] = $use->name->toString();
				}
			} elseif( $node instanceof GroupUse ) {
				foreach( $node->uses as $use ) {
					if( $use->type !== Use_::TYPE_NORMAL ) {
						continue;
					}

					$imports[strtolower($use->getAlias()->toString())] = $node->prefix->toString() . '\\' . $use->name->toString();
				}
			}
		}

		return $imports;
	}

	private function typeFromNode( ?Node $type ) : string {
		if( $type === null ) {
			return 'mixed';
		}

		if( $type instanceof FullyQualified ) {
			return '\\' . (string)$type;
		}

		if( $type instanceof Name ) {
			return (string)$type;
		}

		if( $type instanceof Node\NullableType ) {
			return '?' . $this->typeFromNode($type->type);
		}

		if( $type instanceof Node\UnionType || $type instanceof Node\IntersectionType ) {
			$isUnion  = $type instanceof Node\UnionType;
			$separator = $isUnion ? '|' : '&';
			$types     = [];
			foreach( $type->types as $member ) {
				$memberType = $this->typeFromNode($member);
				if( ($isUnion && $member instanceof Node\IntersectionType) || (!$isUnion && $member instanceof Node\UnionType) ) {
					$memberType = "({$memberType})";
				}

				$types[] = $memberType;
			}

			return implode($separator, $types);
		}

		return (string)$type;
	}

	private function visibility( Node $node ) : string {
		if( method_exists($node, 'isPrivate') && $node->isPrivate() ) {
			return 'private';
		}

		if( method_exists($node, 'isProtected') && $node->isProtected() ) {
			return 'protected';
		}

		return 'public';
	}

	private function visibilityFromFlags( int $flags ) : string {
		if( ($flags & Class_::MODIFIER_PRIVATE) !== 0 ) {
			return 'private';
		}

		if( ($flags & Class_::MODIFIER_PROTECTED) !== 0 ) {
			return 'protected';
		}

		return 'public';
	}

	/** Returns the source class, interface, or trait declaration. */
	public function getReflector() : ?Element {
		$class = reset($this->classes);

		return $class === false ? null : $class->getReflector();
	}

	/**
	 * @mddoc-ignore
	 * @return list<ClassDefinition>
	 */
	public function getClasses() : array {
		return array_values($this->classes);
	}

	/** @mddoc-ignore */
	public function getClass( string $name ) : ?ClassDefinition {
		return $this->findClass($this->classes, $name);
	}

	/**
	 * @param array<string,ClassDefinition> $classes
	 */
	private function findClass( array $classes, string $name ) : ?ClassDefinition {
		foreach( $classes as $class ) {
			if( strcasecmp(ltrim($class->getReflector()->getFqsen(), '\\'), ltrim($name, '\\')) === 0 ) {
				return $class;
			}
		}

		return null;
	}

	/** @mddoc-ignore */
	public function getFileDocBlock() : ?DocBlock {
		return $this->fileDocBlock;
	}

	/**
	 * @return array<string,list<\donatj\MDDoc\Reflectors\Source\Tag>>
	 */
	public function getDocMethods() : array {
		$class = reset($this->classes);

		return $class === false ? [] : $class->getDocMethods();
	}

	/**
	 * @return array<string,list<Element>>
	 */
	public function getMethods() : array {
		$class = reset($this->classes);

		return $class === false ? [] : $class->getMethods();
	}

	/**
	 * @return array<string,list<Element>>
	 */
	public function getConstants() : array {
		$class = reset($this->classes);

		return $class === false ? [] : $class->getConstants();
	}

	/**
	 * @return array<string,list<Element>>
	 */
	public function getProperties() : array {
		$class = reset($this->classes);

		return $class === false ? [] : $class->getProperties();
	}

	/**
	 * @return array<string,Element>
	 */
	public function getFunctions() : array {
		return $this->functions;
	}

}
