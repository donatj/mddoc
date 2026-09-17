<?php

use donatj\MDDoc\Autoloaders\NullLoader;
use donatj\MDDoc\Reflectors\TaxonomyReflectorFactory;
use PHPUnit\Framework\TestCase;

class FileDocBlocksTest extends TestCase {

	public function testFileDocblocksAreNotDeclarationDocblocks() : void {
		$factory = new TaxonomyReflectorFactory;
		$loader  = new NullLoader;

		$fileDoc = $factory->newInstance(__DIR__ . '/fixtures/file-docblocks/FileDoc.php', $loader)->getFileDocBlock();
		self::assertNotNull($fileDoc);
		self::assertSame('File documentation.', $fileDoc->getSummary());

		$globalClassDoc = $factory->newInstance(__DIR__ . '/fixtures/file-docblocks/GlobalClass.php', $loader)->getFileDocBlock();
		self::assertNull($globalClassDoc);
	}

}
