<?php

use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Runner\ConfigFinder;
use PHPUnit\Framework\TestCase;

class ConfigDiscoveryTest extends TestCase {

	public function testConfigPreferenceOrder() : void {
		$files = [ 'mddoc.xml', '.mddoc.xml', 'mddoc.dist.xml', '.mddoc.dist.xml', 'mddoc.xml.dist', '.mddoc.xml.dist' ];

		while( $files ) {
			self::assertSame($files[0], (new ConfigFinder)->find(
				static fn( string $file ) : bool => in_array($file, $files, true)
			));
			array_shift($files);
		}
	}

	public function testMissingConfig() : void {
		$this->expectException(ConfigException::class);
		$this->expectExceptionMessage('No config file found');

		(new ConfigFinder)->find(static fn( string $file ) : bool => false);
	}

}
