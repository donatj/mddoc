<?php

require('vendor/autoload.php');

$filename = '/Users/jessed/Projects/Boomerang/src/Boomerang/HttpRequest.php';

function formatType( $type ) {
	$types = array_filter(explode('|', $type));

	if( !$types ) {
		$types = array( 'mixed' );
	}

	$output = '';
	foreach( $types as $t ) {
		$output .= "`{$t}` | ";
	}

	return '(' . trim($output, ' |') . ')';
}

/**
 * @param $filename
 */
function ScanClassFile( $filename ) {
	$x = new \phpDocumentor\Reflection\FileReflector($filename);
	$x->process();
	$x->scanForMarkers();

	$i = 0;
	foreach( $x->getClasses() as $class ) {

		/**
		 * @var $class phpDocumentor\Reflection\ClassReflector
		 */

		echo '### Class: ' . $class->getShortName() . ' - `' . $class->getName() . '`';
		echo PHP_EOL . PHP_EOL;


		foreach( $class->getMethods() as $method ) {

			/**
			 * @var $method phpDocumentor\Reflection\ClassReflector\MethodReflector
			 */


			if( $method->getVisibility() == 'public' ) {

				if( $block = $method->getDocBlock() ) {
					if($block->getTagsByName('ignore')) {
						continue;
					}
				}

				$name = $method->getShortName();

				$args = getArgumentString($method);

				echo "#### Method: `". $class->getShortName() ."`" . ($method->isStatic() ? '::' : '->') . "`{$name}({$args})`";

				echo PHP_EOL . PHP_EOL;

				if( $block ) {
					if( $methodDescr = $block->getShortDescription() ) {
						echo $methodDescr;
						echo PHP_EOL . PHP_EOL;
					}


					/**
					 * @var $tag phpDocumentor\Reflection\DocBlock\Tag\ParamTag
					 */
					if( $methodParams = $block->getTagsByName('param') ) {
						echo '##### Arguments';
						echo PHP_EOL . PHP_EOL;

						foreach( $block->getTagsByName('param') as $tag ) {

							echo '- `' . $tag->getVariableName() . '` ' . formatType($tag->getType());
							echo PHP_EOL;

							if( $tagDescr = $tag->getDescription() ) {
								echo '	- ' . $tagDescr;
								echo PHP_EOL;
							}

						}

						echo PHP_EOL . PHP_EOL;
					}


					/**
					 * @var $return phpDocumentor\Reflection\DocBlock\Tag\ReturnTag
					 */
					if( $return = current($block->getTagsByName('return')) ) {
						echo '##### Returns';
						echo PHP_EOL . PHP_EOL;

						echo '' . formatType($return->getType()) . (($returnDescr = $return->getDescription()) ? ' - ' . $returnDescr : '');

						echo PHP_EOL . PHP_EOL;
					}

				} else {

				}

				echo PHP_EOL;

			}
		}
	}
}

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
	'Application' => array(
		'/Users/jessed/Projects/Boomerang/src/Boomerang/Boomerang.php',
	),
	'Http'        => array(
		'/Users/jessed/Projects/Boomerang/src/Boomerang/HttpRequest.php',
		'/Users/jessed/Projects/Boomerang/src/Boomerang/HttpResponse.php',
	),
	'Validators'  => array(
		'/Users/jessed/Projects/Boomerang/src/Boomerang/HttpResponseValidator.php',
		'/Users/jessed/Projects/Boomerang/src/Boomerang/JSONValidator.php',
	),
	'Type Expectations' => getFileList( '/Users/jessed/Projects/Boomerang/src/Boomerang/TypeExpectations' )
);

foreach( $documentation as $sectionName => $filenames ) {

	echo '## ' . $sectionName . PHP_EOL . PHP_EOL;

	foreach( $filenames as $filename ) {
//		echo '### ' . $filename . PHP_EOL . PHP_EOL;
		ScanClassFile(trim($filename));
	}
}


//drop($y);