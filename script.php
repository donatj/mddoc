<?php

require('vendor/autoload.php');

$filename = '/Users/jessed/Projects/Boomerang/src/Boomerang/HttpRequest.php';

function formatType( $type ) {
	$types = explode('|', $type);

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

		echo '### Class: `' . $class->getName() . '`';
		echo PHP_EOL . PHP_EOL;


		foreach( $class->getMethods() as $method ) {

			/**
			 * @var $method phpDocumentor\Reflection\ClassReflector\MethodReflector
			 */


			if( $method->getVisibility() == 'public' ) {

				$block = $method->getDocBlock();

				$name = $method->getShortName();
				$args = '';
				foreach( $method->getArguments() as $argument ) {
					$args .= $argument->getName();
					$args .= ', ';
				}
				$args = rtrim($args, ' ,');

				echo "#### Method: `{$name}({$args})`";

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

						echo '' . formatType($return->getType()) . ' ' . $return->getDescription();

						echo PHP_EOL . PHP_EOL;
					}

				} else {

				}

				echo PHP_EOL;

			}
		}
	}
}

$documentation = array(
	'/Users/jessed/Projects/Boomerang/src/Boomerang/HttpRequest.php',
	'/Users/jessed/Projects/Boomerang/src/Boomerang/HttpResponse.php'
);

foreach($documentation as $filename) {
	echo '### ' . $filename . PHP_EOL . PHP_EOL;
	ScanClassFile($filename);
}


//drop($y);