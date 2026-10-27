<?php

use PHPUnit\Framework\TestCase;

class ConfigDiscoveryTest extends TestCase {

	/**
	 * @dataProvider configFileNames
	 */
	public function testDistXmlConfigIsPreferredOverXmlDistConfig( string $preferredConfig, string $fallbackConfig ) : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-config-discovery-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$preferredTarget = $tempDir . '/preferred.md';
			$fallbackTarget  = $tempDir . '/fallback.md';

			$this->writeConfig($tempDir . '/' . $preferredConfig, $preferredTarget, 'Preferred config');
			$this->writeConfig($tempDir . '/' . $fallbackConfig, $fallbackTarget, 'Fallback config');

			[ $exitCode, $output ] = $this->runMDDoc($tempDir);

			self::assertSame(0, $exitCode, $output);
			self::assertSame('Preferred config', file_get_contents($preferredTarget));
			self::assertFileDoesNotExist($fallbackTarget);
		} finally {
			foreach( [
				$tempDir . '/' . $preferredConfig,
				$tempDir . '/' . $fallbackConfig,
				$preferredTarget ?? null,
				$fallbackTarget ?? null,
			] as $file ) {
				if( $file !== null && file_exists($file) ) {
					unlink($file);
				}
			}

			rmdir($tempDir);
		}
	}

	/** @return array<string,array{string,string}> */
	public static function configFileNames() : array {
		return [
			'visible config' => [ 'mddoc.dist.xml', 'mddoc.xml.dist' ],
			'hidden config'  => [ '.mddoc.dist.xml', '.mddoc.xml.dist' ],
		];
	}

	/** @return array{int,string} */
	private function runMDDoc( string $directory ) : array {
		$command = 'cd ' . escapeshellarg($directory) . ' && ' . implode(' ', [
			escapeshellarg(PHP_BINARY),
			escapeshellarg(__DIR__ . '/../composer/bin/mddoc'),
		]) . ' 2>&1';

		exec($command, $output, $exitCode);

		return [ $exitCode, implode(PHP_EOL, $output) ];
	}

	private function writeConfig( string $config, string $target, string $content ) : void {
		self::assertNotFalse(file_put_contents($config, sprintf(
			'<mddoc><docpage target="%s"><text>%s</text></docpage></mddoc>',
			htmlspecialchars($target, ENT_XML1),
			htmlspecialchars($content, ENT_XML1)
		)));
	}

}
