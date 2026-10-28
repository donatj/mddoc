<?php

use donatj\MDDoc\MDDoc;
use PHPUnit\Framework\TestCase;

class ConfigDiscoveryTest extends TestCase {

	public function testDistXmlConfigIsPreferredOverXmlDistConfig() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-config-discovery-' . uniqid('', true);
		$cwd     = getcwd();
		$configs = [ 'mddoc.dist.xml', '.mddoc.dist.xml', 'mddoc.xml.dist', '.mddoc.xml.dist' ];
		self::assertIsString($cwd);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			self::assertTrue(chdir($tempDir));
			foreach( $configs as $config ) {
				file_put_contents($config, '<mddoc><docpage target="README.md"><text>' . $config . '</text></docpage></mddoc>');
			}

			foreach( $configs as $config ) {
				new MDDoc([ 'mddoc' ]);
				self::assertSame($config, file_get_contents('README.md'));
				unlink($config);
			}
		} finally {
			chdir($cwd);
			foreach( array_merge($configs, [ 'README.md' ]) as $file ) {
				$path = $tempDir . '/' . $file;
				if( file_exists($path) ) {
					unlink($path);
				}
			}

			rmdir($tempDir);
		}
	}

}
