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

	public function testEnumsIncludeTraitsInterfacesAndMethods() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-enum-dependencies-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$output      = $tempDir . '/README.md';
			$source      = realpath(__DIR__ . '/fixtures/enums/dependencies/State.php');
			$sourceRoot  = realpath(__DIR__ . '/fixtures/enums/dependencies');
			$config      = $tempDir . '/mddoc.xml';

			self::assertIsString($source);
			self::assertIsString($sourceRoot);
			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><autoloader type="psr4" root="%s" namespace="MDDocTest\\EnumDependencies" /><docpage target="%s"><file name="%s" /></docpage></mddoc>',
				htmlspecialchars($sourceRoot, ENT_XML1),
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($source, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			foreach( [
				'Method: State->contractValue',
				'Returns the value required by the contract.',
				'Method: State->traitValue',
				'Returns a value provided by the trait.',
				'Method: State->enumValue',
				'Returns a value defined directly on the enum.',
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

	public function testGlobalEnumsDoNotEmitEmptyNamespaceDeclarations() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-global-enum-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$output = $tempDir . '/README.md';
			$source = realpath(__DIR__ . '/fixtures/file-docblocks/GlobalEnum.php');
			$config = $tempDir . '/mddoc.xml';

			self::assertIsString($source);
			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><docpage target="%s"><file name="%s" /></docpage></mddoc>',
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($source, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			self::assertStringContainsString("<?php\nenum GlobalEnum {", $markdown);
			self::assertStringNotContainsString('namespace ;', $markdown);
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
