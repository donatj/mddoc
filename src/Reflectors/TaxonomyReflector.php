<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Exceptions\ClassNotReadableException;
use donatj\MDDoc\Reflectors\Source\Argument;
use donatj\MDDoc\Reflectors\Source\DocBlock;
use donatj\MDDoc\Reflectors\Source\DocBlockParser;
use donatj\MDDoc\Reflectors\Source\Element;
use PhpParser\Node;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassConst;
use PhpParser\Node\Stmt\ClassMethod;
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

	/**
	 * @var array{
	 *     docMethods:array<string,list<\donatj\MDDoc\Reflectors\Source\Tag>>,
	 *     methods:array<string,list<Element>>,
	 *     constants:array<string,list<Element>>,
	 *     properties:array<string,list<Element>>
	 * }
	 */
	private array $data;

	private TaxonomyReflectorFactory $parserFactory;
	private ?Element $reflector = null;

	/** @var array<string,Element> */
	private array $functions = [];

	private DocBlockParser $docBlockParser;
	private ?DocBlock $fileDocBlock = null;
	private Standard $prettyPrinter;

	/**
	 * @throws ClassNotReadableException
	 */
	public function __construct( string $filename, AutoloaderInterface $autoLoader, TaxonomyReflectorFactory $parserFactory ) {
		$this->autoLoader     = $autoLoader;
		$this->parserFactory  = $parserFactory;
		$this->docBlockParser = new DocBlockParser;
		$this->prettyPrinter  = new Standard;
		$this->data           = [
			'docMethods' => [],
			'methods'    => [],
			'constants'  => [],
			'properties' => [],
		];

		$source = @file_get_contents($filename);
		if( $source === false ) {
			throw new ClassNotReadableException('failed to read class file', $filename);
		}

		$this->fileDocBlock = $this->docBlockParser->parse($this->getFileDocComment($source));

		try {
			$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
			$nodes  = $parser->parse($source);

			$traverser = new NodeTraverser;
			$traverser->addVisitor(new NameResolver);
			$nodes = $traverser->traverse($nodes ?? []);
		} catch( \Exception $ex ) {
			throw new ClassNotReadableException('failed to read class file', $filename, $ex);
		}

		$this->registerStatements($nodes, '', $this->importsFromNodes($nodes));
	}

	/**
	 * @param Node[] $nodes
	 */
	private function registerStatements( array $nodes, string $namespace = '', array $imports = [] ) : void {
		foreach( $nodes as $node ) {
			if( $node instanceof Namespace_ ) {
				$this->registerStatements($node->stmts, $node->name === null ? '' : $node->name->toString(), $this->importsFromNodes($node->stmts));
			} elseif( $node instanceof Function_ ) {
				$function                            = $this->elementFromFunction($node, $namespace, $imports);
				$this->functions[$function->getName()] = $function;
			} elseif( $node instanceof Class_ || $node instanceof Interface_ || $node instanceof Trait_ ) {
				$this->registerClassReflector($node, $namespace, $imports);
			}
		}
	}

	/**
	 * @param Class_|Interface_|Trait_ $node
	 */
	private function registerClassReflector( Node $node, string $namespace, array $imports ) : void {
		$classDocBlock = $this->docBlockParser->parse($this->getDocComment($node), $namespace, $imports);
		$reflector = new Element(
			$node->name === null ? '' : $node->name->toString(),
			$this->getNamespacedName($node),
			$classDocBlock
		);
		$typeNames = $classDocBlock === null ? [] : $classDocBlock->getTypeNames();

		if( !$this->reflector ) {
			$this->reflector = $reflector;
		}

		if( $docBlock = $reflector->getDocBlock() ) {
			foreach( $docBlock->getTagsByName('method') as $docMethod ) {
				$this->data['docMethods'][$docMethod->getMethodName()][] = $docMethod;
			}
		}

		foreach( $node->stmts as $statement ) {
			if( $statement instanceof ClassMethod ) {
				$method = $this->elementFromMethod($statement, $reflector->getFqsen(), $namespace, $imports, $typeNames);
				$this->data['methods'][$method->getName()][] = $method;

				if( $method->getName() === '__construct' ) {
					$this->registerPromotedProperties($statement, $reflector);
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
					$this->data['constants'][$constant->getName()][] = $constant;
				}
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
					$this->data['properties'][$sourceProperty->getName()][] = $sourceProperty;
				}
			}
		}

		if( $node instanceof Class_ && $node->extends !== null ) {
			$this->mergeDependency((string)$node->extends);
		}

		if( $node instanceof Class_ || $node instanceof Trait_ ) {
			foreach( $node->stmts as $statement ) {
				if( $statement instanceof TraitUse ) {
					foreach( $statement->traits as $trait ) {
						$this->mergeDependency((string)$trait);
					}
				}
			}
		}

		if( $node instanceof Interface_ ) {
			foreach( $node->extends as $interface ) {
				$this->mergeDependency((string)$interface);
			}
		}

		if( $node instanceof Class_ ) {
			foreach( $node->implements as $interface ) {
				$this->mergeDependency((string)$interface);
			}
		}
	}

	private function mergeDependency( string $name ) : void {
		$filename = ($this->autoLoader)($name);
		if( $filename && is_readable($filename) ) {
			$parser     = $this->parserFactory->newInstance($filename, $this->autoLoader);
			$this->data = array_merge_recursive($this->data, $parser->data);
		}
	}

	private function registerPromotedProperties( ClassMethod $method, Element $class ) : void {
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

			$this->data['properties'][$property->getName()][] = $property;
		}
	}

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

	/** @param array<string,true> $typeNames */
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

	private function getFileDocComment( string $source ) : ?string {
		foreach( token_get_all($source) as $token ) {
			if( !is_array($token) ) {
				continue;
			}

			if( $token[0] === T_NAMESPACE ) {
				return null;
			}

			if( $token[0] === T_DOC_COMMENT ) {
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
		return $this->reflector;
	}

	/** @mddoc-ignore */
	public function getFileDocBlock() : ?DocBlock {
		return $this->fileDocBlock;
	}

	/**
	 * @return array<string,list<\donatj\MDDoc\Reflectors\Source\Tag>>
	 */
	public function getDocMethods() : array {
		return $this->data['docMethods'];
	}

	/**
	 * @return array<string,list<Element>>
	 */
	public function getMethods() : array {
		return $this->data['methods'];
	}

	/**
	 * @return array<string,list<Element>>
	 */
	public function getConstants() : array {
		return $this->data['constants'];
	}

	/**
	 * @return array<string,list<Element>>
	 */
	public function getProperties() : array {
		return $this->data['properties'];
	}

	/**
	 * @return array<string,Element>
	 */
	public function getFunctions() : array {
		return $this->functions;
	}

}
