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
use phpDocumentor\Reflection\ClassReflector\MethodReflector;
use phpDocumentor\Reflection\DocBlock;

class ClassFile extends AbstractDocPart implements AutoloaderAware {

	private $autoloader;

	public function output( $depth ) {
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

		$document = new DocumentDepth();

		$factory = new TaxonomyReflectorFactory();

		$reflector = $factory->newInstance($filename, $this->autoloader);
		if( $class = $reflector->getReflector() ) {

			if( !$this->getOption('skip-class-header', true) ) {
				$document->appendChild(new Header('Class: ' . $class->getName() /* . ' \\[ ', new Code('\\' . $class->getNamespace()), ' \\]' */));

				if( $classBlock = $class->getDocBlock() ) {
					if( $this->shouldSkip($classBlock) ) {
						return '';
					}
					$document->appendChild(new Paragraph($classBlock->getText()));
				}
			}

			$showClassPreview = false;

			$classInner = "<?php\n";

			if( $ns = $class->getNamespace() ) {
				$classInner .= "namespace {$class->getNamespace()};\n\n";
			}

			$classInner   .= "class {$class->getShortName()} {\n";
			$constantData = $reflector->getConstants();
			foreach( $constantData as $constants ) {
				/** @var \phpDocumentor\Reflection\ClassReflector\ConstantReflector $constant */
				$constant = reset($constants);
				if( $constantBlock = $constant->getDocBlock() ) {
					if( $this->shouldSkip($constantBlock) ) {
						continue;
					}
					$classInner .= "\t/**\n\t * " . implode("\n\t * ", explode("\n", $constantBlock->getText())) . "\n\t */\n";
				}
				$classInner       .= "\tconst {$constant->getName()} = {$constant->getValue()};\n";
				$showClassPreview = true;
			}

			$propertyData = $reflector->getProperties();
			foreach( $propertyData as $properties ) {
				/** @var \phpDocumentor\Reflection\ClassReflector\PropertyReflector $property */
				$property = reset($properties);
				if( $property->getVisibility() == 'public' ) {
					if( $propertyBlock = $property->getDocBlock() ) {
						if( $this->shouldSkip($propertyBlock) ) {
							continue;
						}

						if( $propertyBlock->getText() ) {
							$classInner .= "\t/**\n\t * " . implode("\n\t * ", explode("\n", $propertyBlock->getText()));
						} else {
							$classInner .= "\t/**";
						}

						if( $vars = $propertyBlock->getTagsByName('var') ) {
							/** @var \phpDocumentor\Reflection\DocBlock\Tag $var */
							$var        = reset($vars);
							$classInner .= "\n\t * @var {$var->getContent()}";
						}

						$classInner .= "\n\t */\n";
					}
					$static     = $property->isStatic() ? 'static ' : '';
					$classInner .= "\tpublic {$static}{$property->getName()}";
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

				if( $method->getVisibility() == 'public' ) {

					$subDocument = new DocumentDepth();
					$document->appendChild($subDocument);

					$name = $method->getShortName();
					$args = $this->getArgumentString($method);

					$block = false;

					/**
					 * @var $subMethod \phpDocumentor\Reflection\ClassReflector\MethodReflector
					 */
					foreach( $methods as $subMethod ) {
						if( $block = $subMethod->getDocBlock() ) {
							break;
						}
					}

					/**
					 * @var $block \phpDocumentor\Reflection\DocBlock
					 */
					if( $block ) {
						if( $this->shouldSkip($block) ) {
							continue;
						}

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
							new Header("Method: {$class->getShortName()}{$operator}{$name}")
						);

						$subDocument->appendChild(
							new CodeBlock("function {$name}({$args})", 'php')
						);

						if( $methodDescr = $block->getShortDescription() ) {
							$subDocument->appendChild($this->descriptionFormat($block->getShortDescription(), $block->getLongDescription()->getContents()));
							//							$output .= PHP_EOL . PHP_EOL;
						}

						if( $deprecatedBlocks = $block->getTagsByName('deprecated') ) {
							$deprecatedDoc = new DocumentDepth();
							$subDocument->appendChild($deprecatedDoc);

							$deprecatedDoc->appendChild(new Header('DEPRECATED'));
							foreach( $deprecatedBlocks as $deprecatedBlock ) {
								if( $content = trim($deprecatedBlock->getContent()) ) {
									$deprecatedDoc->appendChild(new MdText($content));
								}
							}
						}

						/**
						 * @var $tag \phpDocumentor\Reflection\DocBlock\Tag\ParamTag
						 */
						if( $methodParams = $block->getTagsByName('param') ) {

							$paramDoc = new DocumentDepth();
							$subDocument->appendChild($paramDoc);

							$paramDoc->appendChild(new Header('Parameters:'));

							$output = '';
							foreach( $block->getTagsByName('param') as $tag ) {

								$output .= '- ' . $this->formatType($tag->getType()) . ' `' . $tag->getVariableName() . '`';

								if( $tagDescr = $tag->getDescription() ) {
									$output .= ' - ' . $tagDescr;
								}

								$output .= PHP_EOL;
							}

							$paramDoc->appendChild($output);
							$output .= PHP_EOL . PHP_EOL;
						}


						/**
						 * @var $return \phpDocumentor\Reflection\DocBlock\Tag\ReturnTag
						 */
						if( !$this->getOption('skip-method-returns', true) ) {
							if( $return = current($block->getTagsByName('return')) ) {
								$returnDoc = new DocumentDepth();
								$subDocument->appendChild($returnDoc);

								$returnDoc->appendChild(new Header('Returns:'));

								$returnDoc->appendChild(new MdText('- ' . $this->formatType($return->getType(), 'void') . (($returnDescr = $return->getDescription()) ? ' - ' . $returnDescr : '')));
							}
						}
					} else {
						$i++;
						//						$output .= str_repeat('#', $depth + 2) . " Undocumented Method: `" . $class->getShortName() . ($method->isStatic() ? '::' : '->') . "{$name}({$args})`";

						$subDocument = new DocumentDepth();
						$document->appendChild($subDocument);

						$subDocument->appendChild(new Header("Undocumented Method: `" . $class->getShortName() . ($method->isStatic() ? '::' : '->') . "{$name}({$args})`"));
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
			/**
			 * @var $access \phpDocumentor\Reflection\DocBlock\Tag
			 */
			if( $access->getContent() != 'public' ) {
				return true;
			}
		} elseif( $block->getTagsByName('ignore') || $block->getTagsByName('private') ) {
			return true;
		}

		return false;
	}

	private function getArgumentString( MethodReflector $method ) {
		$req_args = array();
		$opt_args = array();
		foreach( $method->getArguments() as $argument ) {
			if( $optDefault = $argument->getDefault() ) {
				$opt_args[] = $argument->getName() . ' = ' . $optDefault;
			} else {
				$req_args[] = $argument->getName();
			}
		}

		$args = implode(', ', $req_args) . ($opt_args ? ($req_args ? ' [, ' : '[ ') : '') . implode(' [, ', $opt_args) . str_repeat(']', count($opt_args));

		return $args;
	}

	/**
	 * @param string $args,...
	 * @return \donatj\MDDom\DocumentDepth
	 */
	private function descriptionFormat( $args ) {
		$string = implode(PHP_EOL, func_get_args());
		$parts  = explode(PHP_EOL, $string);

		$document = new DocumentDepth;

		$runningText = "";
		while( ($part = current($parts)) !== false ) {

			$part = rtrim($part);
			$next = next($parts);

			$lastPart = strrev($part);
			if( $lastPart ) {
				$lastPart = $lastPart[0];
			}

			if( $lastPart == ':' ) {
				if( trim($runningText) ) {
					$document->appendChild(new MdText($this->smartLineTrim($runningText)));
					$runningText = "";
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
			$types = array( $default );
		}

		$output = '';
		foreach( $types as $t ) {
			$output .= "***{$t}*** | ";
		}

		return trim($output, ' |');
	}

	private function smartLineTrim( $data ) {
		return preg_replace('/^\s*\n|\n\s*$/s', '', $data);
	}

	public function setAutoloader( AutoloaderInterface $autoloader ) {
		$this->autoloader = $autoloader;
	}
}