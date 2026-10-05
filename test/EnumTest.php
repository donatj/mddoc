<?php

use donatj\MDDoc\MDDoc;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase {

	public function testBackedAndUnbackedEnumsAreDocumented() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-enums-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$output       = $tempDir . '/README.md';
			$unbackedEnum = realpath(__DIR__ . '/fixtures/enums/UnbackedState.php');
			$backedEnum   = realpath(__DIR__ . '/fixtures/enums/BackedState.php');
			$config       = $tempDir . '/mddoc.xml';

			self::assertIsString($unbackedEnum);
			self::assertIsString($backedEnum);
			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><docpage target="%s"><file name="%s" /><file name="%s" /></docpage></mddoc>',
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($unbackedEnum, ENT_XML1),
				htmlspecialchars($backedEnum, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			foreach( [
				'Enum: MDDocTest\\UnbackedState',
				'enum UnbackedState {',
			"public const LABEL = 'unbacked state';",
				'case Pending;',
				'case Complete;',
				'Enum: MDDocTest\\BackedState',
				'enum BackedState: string {',
				"case Open = 'open';",
				"case Closed = 'closed';",
			] as $needle ) {
				self::assertStringContainsString($needle, $markdown);
			}
		} finally {
			foreach( [ $config ?? null, $output ?? null ] as $file ) {
				if( $file !== null && file_exists($file) ) {
					unlink($file);
				}
			}

			rmdir($tempDir);
		}
	}

	public function testEnumCasesAreNotSkippedAsClassConstants() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-enum-cases-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$output       = $tempDir . '/README.md';
			$unbackedEnum = realpath(__DIR__ . '/fixtures/enums/UnbackedState.php');
			$config       = $tempDir . '/mddoc.xml';

			self::assertIsString($unbackedEnum);
			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><docpage target="%s" skip-class-constants="true"><file name="%s" /></docpage></mddoc>',
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($unbackedEnum, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			self::assertStringContainsString('case Pending;', $markdown);
			self::assertStringNotContainsString("public const LABEL = 'unbacked state';", $markdown);
		} finally {
			foreach( [ $config ?? null, $output ?? null ] as $file ) {
				if( $file !== null && file_exists($file) ) {
					unlink($file);
				}
			}

			rmdir($tempDir);
		}
	}

}
