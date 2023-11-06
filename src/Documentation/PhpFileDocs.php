<?php

/**
 * Generate documentation for a single PHP file
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;
use donatj\MDDoc\Reflectors\TaxonomyReflectorFactory;
use donatj\MDDom\AbstractElement;
use donatj\MDDom\Code;
use donatj\MDDom\CodeBlock;
use donatj\MDDom\DocumentDepth;
use donatj\MDDom\Header;
use donatj\MDDom\HorizontalRule;
use donatj\MDDom\Paragraph;
use donatj\MDDom\Text as MdText;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\Php\Function_;
use phpDocumentor\Reflection\Php\Method;

class PhpFileDocs extends AbstractDocPart implements AutoloaderAware {

	/**
	 * The file to document
	 *
	 * @mddoc-required true
	 */
	public const OPT_NAME = 'name';

	/**
	 * Skip the class header line
	 *
	 * @mddoc-recurse true
	 */
	public const OPT_SKIP_CLASS_HEADER = 'skip-class-header';

	/**
	 * Skip the class constants section
	 *
	 * @mddoc-recurse true
	 */
	public const OPT_SKIP_CLASS_CONSTANTS = 'skip-class-constants';

	/** Regex to filter methods by - specify methods to be matched */
	public const OPT_METHOD_FILTER = 'method-filter';

	/** Skip the method return section */
	public const OPT_SKIP_METHOD_RETURNS = 'skip-method-returns';

	/**
	 * Generate warning for undocumented methods. Defaults to "true".
	 *
	 * @mddoc-recurse true
	 */
	public const OPT_WARN_UNDOCUMENTED = 'warn-undocumented';

	private $autoloader;

	/**
	 * @return AbstractElement|string
	 */
	public function output( int $depth ) {
		$file = $this->getOption(self::OPT_NAME);
		$path = $this->getWorkingFilePath($file);

		return $this->scanSourceFile($path, $depth);
	}

	protected function init() : void {
		$this->requireOption(self::OPT_NAME);
	}

	/**
	 * @return AbstractElement|string
	 */
	private function scanSourceFile( string $filename, int $depth ) {

		$document = new DocumentDepth;
		$factory  = new TaxonomyReflectorFactory;

		$reflector = $factory->newInstance($filename, $this->autoloader);

		$functions = $reflector->getFunctions();
		foreach( $functions as $func ) {
			$block = $func->getDocBlock();
			if( $this->shouldSkip($block) ) {
				continue;
			}

			$name = $func->getName();
			$fqfn = preg_replace('/\s*\(.*$/', '', (string)$func->getFqsen());
			$args = $this->getArgumentString($func);

			$fReturnS = '';
			$fReturn  = (string)$func->getReturnType();
			if( $fReturn !== 'mixed' ) {
				$fReturnS = " : {$fReturn}";
			}

			//			$subDocument = new DocumentDepth;
			//			$document->appendChild($subDocument);

			$document->appendChild(
				new Header("Function: {$fqfn}")
			);

			$document->appendChild(
				new CodeBlock("function {$name}({$args}){$fReturnS}", 'php')
			);

			if( $block ) {
				$subDocument = new DocumentDepth;
				$document->appendChild($subDocument);

				$document->appendChild(
					$this->descriptionFormat(
						$this->getDocStr($block)
					)
				);

				$paramDoc = $this->getParamDocs($block);
				if( $paramDoc ) {
					$subDocument->appendChild($paramDoc);
				}

				$returnDoc = new DocumentDepth;
				$subDocument->appendChild($returnDoc);

				if( $return = current($block->getTagsByName('return')) ) {
					$returnDoc->appendChild(new Header('Returns:'));
					if( $return instanceof DocBlock\Tags\InvalidTag ) {
						drop($filename);
					}

					$returnDoc->appendChild(new MdText('- ' . $this->formatType($return->getType(), 'void') . (($returnDescr = (string)$return->getDescription()) ? ' - ' . $returnDescr : '')));
				}
			}
		}

		if( $class = $reflector->getReflector() ) {

			if( !$this->getOption(self::OPT_SKIP_CLASS_HEADER, true) ) {
				$document->appendChild(new Header('Class: ' . $class->getFqsen() /* . ' \\[ ', new Code('\\' . $class->getNamespace()), ' \\]' */));

				if( $classBlock = $class->getDocBlock() ) {
					if( $this->shouldSkip($classBlock) ) {
						return '';
					}

					$document->appendChild(new Paragraph($this->getDocStr($classBlock)));
				}
			}

			$showClassPreview = false;

			$classInner = "<?php\n";

			// @todo figure some stuff out
			if( $ns = $class->getLocation() ) {
				$classInner .= sprintf("namespace %s;\n\n",
					trim(substr((string)$class->getFqsen(), 0, 0 - strlen($class->getName())), '\\')
				);
			}

			$classInner .= "class {$class->getName()} {\n";

			if( !$this->getOption(self::OPT_SKIP_CLASS_CONSTANTS, true) ) {
				$constantData = $reflector->getConstants();
				foreach( $constantData as $constants ) {
					$constant = reset($constants);

					$visibility = (string)$constant->getVisibility();
					if( $visibility === 'private' ) {
						continue;
					}

					if( $constantBlock = $constant->getDocBlock() ) {
						if( $this->shouldSkip($constantBlock) ) {
							continue;
						}

						$constParts = explode("\n",
							$this->descriptionFormat(
								$this->getDocStr($constantBlock)
							)->exportMarkdown()
						);

						if( $vars = $constantBlock->getTagsByName('var') ) {
							/** @var \phpDocumentor\Reflection\DocBlock\Tags\Var_ $var */
							$var          = reset($vars);
							$constParts[] = '@var ' . (string)$var;
						}

						$constParts = $this->arrayTrim($constParts);

						if( count($constParts) > 1 ) {
							$classInner .= "\t/**\n\t * " . implode("\n\t * ", $constParts) . "\n\t */\n";
						} elseif( count($constParts) === 1 ) {
							$classInner .= "\t/** " . reset($constParts) . " */\n";
						}
					}

					$classInner       .= sprintf("\t%s const %s = %s;\n",
						$visibility,
						$constant->getName(),
						$constant->getValue()
					);
					$showClassPreview = true;
				}
			}

			$propertyData = $reflector->getProperties();
			foreach( $propertyData as $properties ) {

				$property = reset($properties);
				if( (string)$property->getVisibility() !== 'public' ) {
					continue;
				}

				if( $propertyBlock = $property->getDocBlock() ) {
					if( $this->shouldSkip($propertyBlock) ) {
						continue;
					}

					if( $propertyBlock->getSummary() ) {
						$classInner .= "\t/**\n\t * " . implode("\n\t * ", explode("\n", $this->getDocStr($propertyBlock)));
					} else {
						$classInner .= "\t/**";
					}

					if( $vars = $propertyBlock->getTagsByName('var') ) {
						/** @var \phpDocumentor\Reflection\DocBlock\Tags\Var_ $var */
						$var        = reset($vars);
						$classInner .= "\n\t * @var " . (string)$var;
					}

					$classInner .= "\n\t */\n";
				}

				$static     = $property->isStatic() ? 'static ' : '';
				$classInner .= "\tpublic {$static}\${$property->getName()}";
				if( $property->getDefault() ) {
					$classInner .= " = {$property->getDefault()}";
				}

				$classInner .= ";\n";

				$showClassPreview = true;
			}

			$classInner .= '}';

			if( $showClassPreview ) {
				$document->appendChild(new CodeBlock($classInner, 'php'));
			}

			$docMethodData = $reflector->getDocMethods();
			$i             = 0;
			foreach( $docMethodData as $docMethods ) {
				$i++;

				$docMethod = reset($docMethods);

				$name = $docMethod->getMethodName();

				$fReturnS = '';
				$fReturn  = (string)$docMethod->getReturnType();
				if( $fReturn !== 'mixed' ) {
					$fReturnS = " : {$fReturn}";
				}

				$subDocument = new DocumentDepth;
				$document->appendChild($subDocument);

				if( $i > 1 ) {
					$subDocument->appendChild(new HorizontalRule);
				}

				$operator = $docMethod->isStatic() ? '::' : '->';

				$subDocument->appendChild(
					new Header("Magic Method: {$class->getName()}{$operator}{$name}")
				);

				$args     = '';
				$argParts = $docMethod->getArguments();
				foreach( $argParts as $argPart ) {
					$prefix = '';
					if( (string)$argPart['type'] !== 'mixed' ) {
						$prefix = "{$argPart['type']} ";
					}

					$args .= $prefix . '$' . $argPart['name'] . ', ';
				}

				$args = rtrim($args, ', ');

				$subDocument->appendChild(
					new CodeBlock("function {$name}({$args}){$fReturnS}", 'php')
				);

				if( $docMethodDescr = $docMethod->getDescription() ) {
					$subDocument->appendChild(
						$this->descriptionFormat(
							(string)$docMethodDescr
						)
					);
				}
			}

			$methodData = $reflector->getMethods();

			$i = 0;
			foreach( $methodData as $methods ) {
				$i++;

				$method = reset($methods);

				if( (string)$method->getVisibility() !== 'public' ) {
					continue;
				}

				$name = $method->getName();
				$args = $this->getArgumentString($method);

				$fReturnS = '';
				$fReturn  = (string)$method->getReturnType();
				if( $fReturn !== 'mixed' ) {
					$fReturnS = " : {$fReturn}";
				}

				/** @var \phpDocumentor\Reflection\DocBlock[] $blocks */
				$blocks = [];

				foreach( $methods as $subMethod ) {
					if( $block = $subMethod->getDocBlock() ) {
						$blocks[] = $block;
					}
				}

				foreach( $blocks as $block ) {
					if( $this->shouldSkip($block) ) {
						continue 2;
					}
				}

				$subDocument = new DocumentDepth;
				$document->appendChild($subDocument);

				$firstBlock = reset($blocks);

				$operator = $method->isStatic() ? '::' : '->';

				$canonicalMethodName = $class->getName() . $operator . "$name($args)";

				if( $methodFilter = $this->getOption(self::OPT_METHOD_FILTER, true) ) {
					if( !preg_match($methodFilter, $canonicalMethodName) ) {
						continue;
					}
				}

				if( $i > 1 ) {
					$subDocument->appendChild(new HorizontalRule);
				}

				if( $firstBlock ) {
					$subDocument->appendChild(
						new Header("Method: {$class->getName()}{$operator}{$name}")
					);

					$subDocument->appendChild(
						new CodeBlock("function {$name}({$args}){$fReturnS}", 'php')
					);

					foreach( $blocks as $block ) {
						if( $block->getSummary() ) {
							$subDocument->appendChild(
								$this->descriptionFormat(
									$this->getDocStr($block)
								)
							);
						}
					}

					if( $deprecatedBlocks = $firstBlock->getTagsByName('deprecated') ) {
						$deprecatedDoc = new DocumentDepth;
						$subDocument->appendChild($deprecatedDoc);

						$deprecatedDoc->appendChild(new Header('DEPRECATED'));
						foreach( $deprecatedBlocks as $deprecatedBlock ) {
							if( $content = trim($deprecatedBlock->getDescription()) ) {
								$deprecatedDoc->appendChild(new MdText($content));
							}
						}
					}

					foreach( $blocks as $block ) {
						$paramDoc = $this->getParamDocs($block);
						if( $paramDoc ) {
							$subDocument->appendChild($paramDoc);
							break;
						}
					}

					if( $throwsBlocks = $firstBlock->getTagsByName('throws') ) {
						$throwsDoc = new DocumentDepth;
						$subDocument->appendChild($throwsDoc);

						/** @var \phpDocumentor\Reflection\DocBlock\Tags\Throws $throwsBlock */
						foreach( $throwsBlocks as $throwsBlock ) {
							$throwsParagraph = new Paragraph(
								new MdText('**Throws**: '),
								new Code($throwsBlock->getType())
							);
							$throwsDoc->appendChild($throwsParagraph);

							if( $content = trim($throwsBlock->getDescription()) ) {
								$throwsParagraph->appendChild(new MdText(' - ' . $content));
							}
						}
					}

					if( !$this->getOption(self::OPT_SKIP_METHOD_RETURNS, true) ) {
						if( $return = current($firstBlock->getTagsByName('return')) ) {
							$returnDoc = new DocumentDepth;
							$subDocument->appendChild($returnDoc);

							$returnDoc->appendChild(new Header('Returns:'));
							if( $return instanceof DocBlock\Tags\InvalidTag ) {
								drop($filename);
							}

							$returnDoc->appendChild(new MdText('- ' . $this->formatType($return->getType(), 'void') . (($returnDescr = (string)$return->getDescription()) ? ' - ' . $returnDescr : '')));
						}
					}
				} else {
					$subDocument = new DocumentDepth;
					$document->appendChild($subDocument);

					// @todo Special rules for constructors and other "built ins"
					$title = 'Undocumented Method';
					if( $this->getOption(self::OPT_WARN_UNDOCUMENTED, true) === 'false' ) {
						$title = 'Method';
					}

					$subDocument->appendChild(new Header("{$title}: `{$class->getName()}{$operator}{$name}({$args})`"));
				}
			}
		}

		return $document;
	}

	private function shouldSkip( DocBlock $block ) : bool {
		if( $access = $block->getTagsByName('access') ) {
			$access = reset($access);
			if( (string)$access->getDescription() !== 'public' ) {
				return true;
			}
		} elseif( $block->getTagsByName('ignore')
			|| $block->getTagsByName('private')
			|| $block->getTagsByName('internal')
		) {
			return true;
		}

		return false;
	}

	/**
	 * @param Function_|Method $method
	 */
	private function getArgumentString( $method ) : string {
		$req_args = [];
		$opt_args = [];
		foreach( $method->getArguments() as $argument ) {
			$prefix = '';
			if( (string)$argument->getType() !== 'mixed' ) {
				$prefix = "{$argument->getType()} ";
			}

			if( $argument->isVariadic() ) {
				$prefix .= '...';
			}

			// @todo: the types are currently borked on default parameters.
			$optDefault = $argument->getDefault();
			if( $optDefault !== null ) {
				$opt_args[] = $prefix . '$' . $argument->getName() . ' = ' . $optDefault;
			} else {
				$req_args[] = $prefix . '$' . $argument->getName();
			}
		}

		return implode(', ', $req_args) .
			($opt_args ? ($req_args ? ' [, ' : '[ ') : '') .
			implode(' [, ', $opt_args) . str_repeat(']', count($opt_args));
	}

	private function descriptionFormat( string ...$args ) : DocumentDepth {
		$string = implode(PHP_EOL, $args);
		$parts  = explode(PHP_EOL, $string);

		$document = new DocumentDepth;

		$runningText = '';
		while( ($part = current($parts)) !== false ) {

			$part = rtrim($part);
			next($parts);

			$lastPart = strrev($part);
			if( $lastPart ) {
				$lastPart = $lastPart[0];
			}

			if( $lastPart === ':' ) {
				if( trim($runningText) ) {
					$document->appendChild(new MdText($this->smartLineTrim($runningText)));
					$runningText = '';
				}

				$document->appendChild(new Header(substr($part, 0, -1)));
			} else {
				$runningText .= "  \n" . $part; // @todo this is gross... fix this.
			}
		}

		if( trim($runningText) ) {
			$document->appendChild(new MdText($this->smartLineTrim($runningText)));
		}

		return $document;
	}

	private function formatType( ?string $type, string $default = 'mixed' ) : string {
		$types = array_filter(explode('|', $type ?? ''));

		if( !$types ) {
			$types = [ $default ];
		}

		$output = '';
		foreach( $types as $t ) {
			$output .= "***{$t}*** | ";
		}

		return trim($output, ' |');
	}

	private function smartLineTrim( string $data ) : string {
		return preg_replace('/^\s*\n|\n\s*$/', '', $data);
	}

	public function setAutoloader( AutoloaderInterface $autoloader ) : void {
		$this->autoloader = $autoloader;
	}

	private function getDocStr( DocBlock $block ) : string {
		return trim(
			trim($block->getSummary()) .
			"\n\n" .
			trim($block->getDescription()->__toString())
		);
	}

	private function arrayTrim( array $sv ) : array {
		$s   = 0;
		$svn = null;
		$c   = count($sv);
		for( $i = 0; $i < $c; $i++ ) {
			if( !empty($sv[$i]) ) {
				$svn[$s++] = trim($sv[$i]);
			}
		}

		return $svn;
	}

	private function getParamDocs( DocBlock $block ) : ?DocumentDepth {
		/** @var \phpDocumentor\Reflection\DocBlock\Tags\Param[] $methodParams */
		if( $methodParams = $block->getTagsByName('param') ) {
			$paramDoc = new DocumentDepth;

			$paramDoc->appendChild(new Header('Parameters:'));

			$output = '';
			foreach( $methodParams as $tag ) {

				$output .= sprintf('- %s `$%s`', $this->formatType($tag->getType()), $tag->getVariableName());

				if( $tagDescr = (string)$tag->getDescription() ) {
					$output .= ' - ' . $tagDescr;
				}

				$output .= PHP_EOL;
			}

			$paramDoc->appendChild($output);

			return $paramDoc;
		}

		return null;
	}

	public static function tagName() : string {
		return 'file';
	}

}
