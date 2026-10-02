<?php

use donatj\MDDoc\Runner\FileDocumentationOutputStrategy;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class FileDocumentationOutputStrategyTest extends TestCase {

	public function testCreatesZeroNamedDirectory() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-output-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));
		$target = $tempDir . '/0/generated/README.md';

		try {
			$strategy = new FileDocumentationOutputStrategy(new NullLogger);

			self::assertTrue($strategy->write($target, static function () : string {
				return 'Generated documentation';
			}));
			self::assertSame('Generated documentation', file_get_contents($target));
		} finally {
			if( file_exists($target) ) {
				unlink($target);
			}

			foreach( [ dirname($target), dirname(dirname($target)), $tempDir . '/generated', $tempDir ] as $directory ) {
				if( is_dir($directory) ) {
					rmdir($directory);
				}
			}
		}
	}

}
