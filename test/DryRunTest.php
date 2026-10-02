<?php

use donatj\MDDoc\Exceptions\DryRunMismatchException;
use donatj\MDDoc\MDDoc;
use donatj\MDDoc\Runner\DryRunDocumentationOutputStrategy;
use PHPUnit\Framework\TestCase;

class DryRunTest extends TestCase {

	public function testDryRunChecksExistingOutputWithoutWriting() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-dry-run-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$target = $tempDir . '/README.md';
			$config = $this->writeConfig($tempDir, $target);

			new MDDoc([ 'mddoc', $config ]);

			$expected = file_get_contents($target);
			self::assertIsString($expected);
			self::assertTrue(touch($target, 1234567890));

			[ $exitCode, $output ] = $this->runDryRun($config);
			self::assertSame(0, $exitCode, $output);
			self::assertSame($expected, file_get_contents($target));
			self::assertSame(1234567890, filemtime($target));

			self::assertNotFalse(file_put_contents($target, 'outdated documentation'));
			self::assertTrue(touch($target, 1234567890));

			[ $exitCode, $output ] = $this->runDryRun($config);
			self::assertSame(1, $exitCode, $output);
			self::assertStringContainsString("output '{$target}' differs", $output);
			self::assertSame('outdated documentation', file_get_contents($target));
			self::assertSame(1234567890, filemtime($target));
		} finally {
			foreach( [ $config ?? null, $target ?? null ] as $file ) {
				if( $file !== null && file_exists($file) ) {
					unlink($file);
				}
			}

			rmdir($tempDir);
		}
	}

	public function testDryRunDoesNotCreateMissingTargetDirectory() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-dry-run-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$target = $tempDir . '/generated/README.md';
			$config = $this->writeConfig($tempDir, $target);

			[ $exitCode, $output ] = $this->runDryRun($config);
			self::assertSame(1, $exitCode, $output);
			self::assertDirectoryDoesNotExist(dirname($target));
		} finally {
			if( isset($config) && file_exists($config) ) {
				unlink($config);
			}

			rmdir($tempDir);
		}
	}

	public function testDryRunStrategyThrowsForMismatchedOutput() : void {
		$target = tempnam(sys_get_temp_dir(), 'mddoc-dry-run-');
		self::assertIsString($target);

		try {
			self::assertNotFalse(file_put_contents($target, 'outdated documentation'));

			try {
				(new DryRunDocumentationOutputStrategy)->write($target, static function () : string {
					return 'generated documentation';
				});

				self::fail('Expected a dry run mismatch exception');
			} catch( DryRunMismatchException $e ) {
				self::assertSame($target, $e->getTarget());
			}
		} finally {
			unlink($target);
		}
	}

	public function testDryRunStrategyThrowsForDirectoryTarget() : void {
		$target = sys_get_temp_dir() . '/mddoc-dry-run-' . uniqid('', true);
		self::assertTrue(mkdir($target, 0700));
		$rendered = false;

		try {
			try {
				(new DryRunDocumentationOutputStrategy)->write($target, function () use ( &$rendered ) : string {
					$rendered = true;

					return '';
				});

				self::fail('Expected a dry run mismatch exception');
			} catch( DryRunMismatchException $e ) {
				self::assertSame($target, $e->getTarget());
			}

			self::assertTrue($rendered);
		} finally {
			rmdir($target);
		}
	}

	/** @return array{int,string} */
	private function runDryRun( string $config ) : array {
		$command = implode(' ', [
			escapeshellarg(PHP_BINARY),
			escapeshellarg(__DIR__ . '/../composer/bin/mddoc'),
			'--dry-run=true',
			escapeshellarg($config),
		]) . ' 2>&1';

		exec($command, $output, $exitCode);

		return [ $exitCode, implode(PHP_EOL, $output) ];
	}

	private function writeConfig( string $tempDir, string $target ) : string {
		$config = $tempDir . '/mddoc.xml';
		self::assertNotFalse(file_put_contents($config, sprintf(
			'<mddoc><docpage target="%s"><text>Generated documentation</text></docpage></mddoc>',
			htmlspecialchars($target, ENT_XML1)
		)));

		return $config;
	}

}
