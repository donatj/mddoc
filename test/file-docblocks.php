<?php

require __DIR__ . '/../vendor/autoload.php';

use donatj\MDDoc\Autoloaders\NullLoader;
use donatj\MDDoc\Reflectors\TaxonomyReflectorFactory;

$factory = new TaxonomyReflectorFactory;
$loader  = new NullLoader;

$fileDoc = $factory->newInstance(__DIR__ . '/fixtures/file-docblocks/FileDoc.php', $loader)->getFileDocBlock();
if( $fileDoc === null || $fileDoc->getSummary() !== 'File documentation.' ) {
	throw new RuntimeException('Expected the file docblock before a namespace to be retained');
}

$globalClassDoc = $factory->newInstance(__DIR__ . '/fixtures/file-docblocks/GlobalClass.php', $loader)->getFileDocBlock();
if( $globalClassDoc !== null ) {
	throw new RuntimeException('A global class docblock must not be treated as file documentation');
}
