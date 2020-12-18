<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;
use donatj\MDDoc\Reflectors\TaxonomyReflectorFactory;
use donatj\MDDom\CodeBlock;
use donatj\MDDom\DocumentDepth;
use donatj\MDDom\Header;
use donatj\MDDom\HorizontalRule;
use donatj\MDDom\Paragraph;
use donatj\MDDom\Text as MdText;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\Php\Method;

class ClassFile extends AbstractDocPart implements AutoloaderAware {

	private $autoloader;

	public function output( int $depth ) {
		return $this->scanClassFile($this->getOption('name'), $depth);
	}

	protected function init() {
		$this->requireOptions('name');
	}

	/**
	 * @param string $filename
	 * @param int    $depth
	 * @return string
	 */
	private function scanClassFile( $filename, $depth ) {
		$output = '';

		$document = new DocumentDepth;

		$factory = new TaxonomyReflectorFactory;

		$reflector = $factory->newInstance($filename, $this->autoloader);
		if( $class = $reflector->getReflector() ) {

			if( !$this->getOption('skip-class-header', true) ) {
				$document->appendChild(new Header('Class: ' . $class->getFqsen() /* . ' \\[ ', new Code('\\' . $class->getNamespace()), ' \\]' */));

				if( $classBlock = $class->getDocBlock() ) {
					if( $this->shouldSkip($classBlock) ) {
						return '';
					}

					$document->appendChild(new Paragraph($classBlock->getSummary()));
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

			$classInner   .= "class {$class->getName()} {\n";
			$constantData = $reflector->getConstants();
			foreach( $constantData as $constants ) {
				$constant = reset($constants);
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

				$classInner       .= sprintf("\tconst %s = %s;\n",
					$constant->getName(),
					$constant->getValue()
				);
				$showClassPreview = true;
			}

			$propertyData = $reflector->getProperties();
			foreach( $propertyData as $properties ) {

				$property = reset($properties);
				if( (string)$property->getVisibility() === 'public' ) {
					/** @var DocBlock $propertyBlock */
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
			}

			$classInner .= '}';

			if( $showClassPreview ) {
				$document->appendChild(new CodeBlock($classInner, 'php'));
			}

			$methodData = $reflector->getMethods();

			$i = 0;
			foreach( $methodData as $methods ) {
				$method = reset($methods);

				if( (string)$method->getVisibility() === 'public' ) {

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

					if( $firstBlock ) {
						$operator            = ($method->isStatic() ? '::' : '->');
						$canonicalMethodName = $class->getName() . $operator . "$name($args)";

						if( $methodFilter = $this->getOption('method-filter') ) {
							if( !preg_match($methodFilter, $canonicalMethodName) ) {
								continue;
							}
						}

						$i++;

						if( $i > 1 ) {
							$subDocument->appendChild(new HorizontalRule);
						}

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

							if( $methodParams = $block->getTagsByName('param') ) {

								$paramDoc = new DocumentDepth;
								$subDocument->appendChild($paramDoc);

								$paramDoc->appendChild(new Header('Parameters:'));

								$output = '';
								foreach( $block->getTagsByName('param') as $tag ) {

									$output .= sprintf('- %s `$%s`', $this->formatType($tag->getType()), $tag->getVariableName());

									if( $tagDescr = (string)$tag->getDescription() ) {
										$output .= ' - ' . $tagDescr;
									}

									$output .= PHP_EOL;
								}

								$paramDoc->appendChild($output);
								$output .= PHP_EOL . PHP_EOL;
								break;
							}
						}

						if( !$this->getOption('skip-method-returns', true) ) {
							if( $return = current($firstBlock->getTagsByName('return')) ) {
								$returnDoc = new DocumentDepth;
								$subDocument->appendChild($returnDoc);

								$returnDoc->appendChild(new Header('Returns:'));

								$returnDoc->appendChild(new MdText('- ' . $this->formatType($return->getType(), 'void') . (($returnDescr = (string)$return->getDescription()) ? ' - ' . $returnDescr : '')));
							}
						}
					} else {
						$i++;
						//						$output .= str_repeat('#', $depth + 2) . " Undocumented Method: `" . $class->getShortName() . ($method->isStatic() ? '::' : '->') . "{$name}({$args})`";

						$subDocument = new DocumentDepth;
						$document->appendChild($subDocument);

						$subDocument->appendChild(new Header("Undocumented Method: `" . $class->getName() . ($method->isStatic() ? '::' : '->') . "{$name}({$args})`"));
					}

					$output .= PHP_EOL;
				}
			}
		}

		return $document;
	}

	private function shouldSkip( DocBlock $block ) {
		if( $access = $block->getTagsByName('access') ) {
			$access = reset($access);
			if( (string)$access->getDescription() !== 'public' ) {
				return true;
			}
		} elseif( $block->getTagsByName('ignore')
				  || $block->getTagsByName('private')
				  || $block->getTagsByName('internal') ) {
			return true;
		}

		return false;
	}

	private function getArgumentString( Method $method ) {
		$req_args = [];
		$opt_args = [];
		foreach( $method->getArguments() as $argument ) {
			$prefix = '';
			if( (string)$argument->getType() !== 'mixed' ) {
				$prefix = "{$argument->getType()} ";
				if( $argument->isVariadic() ) {
					$prefix .= '...';
				}
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

	/**
	 * @return DocumentDepth
	 */
	private function descriptionFormat( $args ) {
		$string = implode(PHP_EOL, func_get_args());
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

	private function formatType( $type, $default = 'mixed' ) {
		$types = array_filter(explode('|', $type));

		if( !$types ) {
			$types = [ $default ];
		}

		$output = '';
		foreach( $types as $t ) {
			$output .= "***{$t}*** | ";
		}

		return trim($output, ' |');
	}

	private function smartLineTrim( $data ) {
		return preg_replace('/^\s*\n|\n\s*$/', '', $data);
	}

	public function setAutoloader( AutoloaderInterface $autoloader ) : void {
		$this->autoloader = $autoloader;
	}

	public function getDocStr( DocBlock $block ) : string {
		return trim(
			trim((string)$block->getSummary()) .
			"\n\n" .
			trim((string)$block->getDescription())
		);
	}

	private function arrayTrim( $sv ) : array {
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

}
