<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;
use donatj\MDDoc\Reflectors\TaxonomyReflectorFactory;
use donatj\MDDom\Code;
use donatj\MDDom\DocumentDepth;
use donatj\MDDom\Header;
use donatj\MDDom\HorizontalRule;
use donatj\MDDom\Paragraph;
use donatj\MDDom\Text as MdText;
use phpDocumentor\Reflection\ClassReflector\MethodReflector;

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

		$methodData = $reflector->getMethods();
		if( $class = $reflector->getReflector() ) {

			if( !$this->getOption('skip-class-header', true) ) {
//				$output .= str_repeat('#', $depth + 1) . ' Class: ' . $class->getShortName() . ' \\[ `\\' . $class->getNamespace() . '` \\]';
				$document->appendChild(new Header('Class: ' . $class->getShortName() . ' \\[ ', new Code('\\' . $class->getNamespace()), ' \\]'));
//				$output .= PHP_EOL . PHP_EOL;

				if( $classBlock = $class->getDocBlock() ) {
					$document->appendChild(new Paragraph($classBlock->getText()));
//					$output .= $classBlock->getText();
//					$output .= PHP_EOL . PHP_EOL;
				}
			}

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
						if( $access = $block->getTagsByName('access') ) {
							$access = reset($access);
							/**
							 * @var $access \phpDocumentor\Reflection\DocBlock\Tag
							 */

							if( $access->getContent() == 'private' ) {
								continue;
							}
						} elseif( $block->getTagsByName('ignore') || $block->getTagsByName('access') ) {
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
							new Header('Method: ', new Code($class->getShortName() . "{$operator}{$name}({$args})"))
						);

						if( $methodDescr = $block->getShortDescription() ) {
							$subDocument->appendChild($this->descriptionFormat($block->getShortDescription(), $block->getLongDescription()->getContents()));
//							$output .= PHP_EOL . PHP_EOL;
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

//								$output .= str_repeat('#', $depth + 3) . ' Returns:';
								$returnDoc->appendChild(new Header('Returns:'));
//								$output .= PHP_EOL . PHP_EOL;

								$returnDoc->appendChild(new MdText('- ' . $this->formatType($return->getType(), 'void') . (($returnDescr = $return->getDescription()) ? ' - ' . $returnDescr : '')));

								$output .= PHP_EOL . PHP_EOL;
							}
						}

					} else {
						$i++;
						$output .= str_repeat('#', $depth + 2) . " Undocumented Method: `" . $class->getShortName() . ($method->isStatic() ? '::' : '->') . "{$name}({$args})`";
					}

					$output .= PHP_EOL;

				}

			}
		}

		return $document;
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
	 * @return \donatj\MDDom\DocumentDepth
	 */
	private function  descriptionFormat() {
		$string = implode(PHP_EOL, func_get_args());
		$parts  = explode(PHP_EOL, $string);

		$document = new DocumentDepth;

		$output = '';

		while( ($part = current($parts)) !== false ) {

			$part = rtrim($part);
			$next = next($parts);

			$lastPart = strrev($part);
			if( $lastPart ) {
				$lastPart = $lastPart[0];
			}

			if( $lastPart == ':' ) {
				$document->appendChild(new Header(substr($part, 0, -1)));
			} else {
				$document->appendChild(new Paragraph($part));
			}
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

	public function setAutoloader( AutoloaderInterface $autoloader ) {
		$this->autoloader = $autoloader;
	}

} 