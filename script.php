<?php

require('vendor/autoload.php');

//define('STDERR', STDOUT);

spl_autoload_register(function ( $className ) {
	$className = ltrim($className, '\\');
	$fileName  = '';
	$namespace = '';
	if( $lastNsPos = strrpos($className, '\\') ) {
		$namespace = substr($className, 0, $lastNsPos);
		$className = substr($className, $lastNsPos + 1);
		$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}
	$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

	$fileName = dirname(__FILE__) . '/src/' . $fileName;
	if( file_exists($fileName) ) {
		require($fileName);
	}
});

$filename = '/Users/jessed/Projects/Boomerang/src/Boomerang/HttpRequest.php';

function formatType( $type, $default = 'mixed' ) {
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

function ScanClassFile( $filename, $autoloader ) {
	$x = new \phpDocumentor\Reflection\FileReflector($filename);
	$x->process();
	$x->scanForMarkers();

	$factory = new \donatj\MDDoc\TaxonomyReflectorFactory();

	$n = $factory->newInstance($filename, $autoloader);

	$methodData = $n->getMethods();
	if( $class = $n->getReflector() ) {

		echo '### Class: ' . $class->getShortName() . ' - `' . $class->getName() . '`';
		echo PHP_EOL . PHP_EOL;

		if( $classBlock = $class->getDocBlock() ) {
			echo $classBlock->getText();
			echo PHP_EOL . PHP_EOL;
		}

		$i = 0;
		foreach( $methodData as $methods ) {
			$method = reset($methods);

			if( $method->getVisibility() == 'public' ) {


				$name = $method->getShortName();
//				see($class->getInterfaces(), $class->getParentClass());
				$args = getArgumentString($method);

				$block = false;
				foreach( $methods as $xmethod ) {
					if( $block = $xmethod->getDocBlock() ) {
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

					$i++;

					if( $i > 1 ) {
						echo '---' . PHP_EOL . PHP_EOL;
					}

					echo "#### Method: `" . $class->getShortName() . "`" . ($method->isStatic() ? '::' : '->') . "`{$name}({$args})`";

					echo PHP_EOL . PHP_EOL;

					if( $methodDescr = $block->getShortDescription() ) {

						echo descriptionFormat($block->getShortDescription(), $block->getLongDescription()->getContents());

//						see('x', $methodDescr, $methodDescr->getContents(), $block->getShortDescription());
						echo PHP_EOL . PHP_EOL;
					}


					/**
					 * @var $tag phpDocumentor\Reflection\DocBlock\Tag\ParamTag
					 */
					if( $methodParams = $block->getTagsByName('param') ) {


						echo '##### Parameters';
						echo PHP_EOL . PHP_EOL;

						foreach( $block->getTagsByName('param') as $tag ) {

							echo '- ' . formatType($tag->getType()) . ' `' . $tag->getVariableName() . '`';


							if( $tagDescr = $tag->getDescription() ) {
								echo ' - ' . $tagDescr;

							}

							echo PHP_EOL;

						}

						echo PHP_EOL . PHP_EOL;
					}


					/**
					 * @var $return phpDocumentor\Reflection\DocBlock\Tag\ReturnTag
					 */
					if( $return = current($block->getTagsByName('return')) ) {
						echo '##### Returns';
						echo PHP_EOL . PHP_EOL;

						echo '- ' . formatType($return->getType(), 'void') . (($returnDescr = $return->getDescription()) ? ' - ' . $returnDescr : '');

						echo PHP_EOL . PHP_EOL;
					}

				} else {
					$i++;
					echo "#### Undocumented Method: `" . $class->getShortName() . "`" . ($method->isStatic() ? '::' : '->') . "`{$name}({$args})`";
				}

				echo PHP_EOL;

			}

		}
	}
}

function descriptionFormat() {
	$string = implode(PHP_EOL, func_get_args());
	$parts  = explode(PHP_EOL, $string);

	$output = '';

	while( ($part = current($parts)) !== false ) {

		$part = rtrim($part);
		$next = next($parts);

		$lastPart = strrev($part);
		if( $lastPart ) {
			$lastPart = $lastPart[0];
		}

		if( $lastPart == ':' ) {
			$part = '##### ' . substr($part, 0, -1);
		}

		if( in_array($lastPart, array( ',', '.', ';' )) || (strlen($next) > 3 && $next[0] = ' ' && $next[1] == ' ' && $next[2] == ' ') || trim($next) == '' ) {
			$output .= $part . '  ' . PHP_EOL;
		} else {
			$output .= $part;
		}

	}


	return $output;
}

//function getUnified( phpDocumentor\Reflection\ClassReflector\MethodReflector $method ) {

/**
 * @param $method
 * @return string
 */
function getArgumentString( phpDocumentor\Reflection\ClassReflector\MethodReflector $method ) {
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

function getFileList( $path ) {
	if( $real = realpath($path) ) {
		$path = $real;
	}

	$path = rtrim($path, DIRECTORY_SEPARATOR);

	if( is_dir($path) ) {
		$dir   = new \RecursiveDirectoryIterator($path);
		$ite   = new \RecursiveIteratorIterator($dir);
		$files = new \RegexIterator($ite, "/\.php$/");

		return $files;
	} elseif( is_readable($path) ) {
		return new \ArrayIterator(array( $path ));
	}


	$this->ui->dropError("Cannot find file \"$path\"");

}

$documentation = array(
	'Application'       => array(
		'/Users/jessed/Projects/Boomerang/src/Boomerang/Boomerang.php',
	),
	'Http'              => array(
		'/Users/jessed/Projects/Boomerang/src/Boomerang/HttpRequest.php',
		'/Users/jessed/Projects/Boomerang/src/Boomerang/HttpResponse.php',
	),
	'Validators'        => array(
		'/Users/jessed/Projects/Boomerang/src/Boomerang/HttpResponseValidator.php',
		'/Users/jessed/Projects/Boomerang/src/Boomerang/JSONValidator.php',
	),
	'Type Expectations' => getFileList('/Users/jessed/Projects/Boomerang/src/Boomerang/TypeExpectations')
);

foreach( $documentation as $sectionName => $filenames ) {

	echo '## ' . $sectionName . PHP_EOL . PHP_EOL;

	foreach( $filenames as $filename ) {
//		echo '### ' . $filename . PHP_EOL . PHP_EOL;
		try {
			ScanClassFile(trim($filename), PSR0('/Users/jessed/Projects/Boomerang/src/') );
		} catch(\phpDocumentor\Reflection\Exception\UnreadableFile $ex) {
			drop($ex->getMessage(), $ex->getFile(), $ex->getTrace());
		}
	}
}

function PSR0( $root ) {
	$root = rtrim($root, '/') . '/';
	return function ( $className ) use ($root) {
		$className = ltrim($className, '\\');
		$fileName  = '';
		$namespace = '';
		if( $lastNsPos = strrpos($className, '\\') ) {
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}
		$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

		$fileName = $root . $fileName;
		if( file_exists($fileName) ) {
			return $fileName;
		}

		return null;
	};
}
