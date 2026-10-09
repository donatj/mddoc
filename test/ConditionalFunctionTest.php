<?php

use donatj\MDDoc\MDDoc;
use PHPUnit\Framework\TestCase;

class ConditionalFunctionTest extends TestCase {

	public function testDeclarationsInsideNestedStatementsAreDocumented() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-nested-declarations-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$output = $tempDir . '/README.md';
			$config = $tempDir . '/mddoc.xml';
			$files  = '';

			foreach( [ 'FunctionGuard.php', 'TryFunction.php', 'FunctionDeclarations.php', 'ClassMethodDeclarations.php', 'ClassGuard.php', 'EnumGuard.php', 'InterfaceGuard.php', 'TraitGuard.php' ] as $file ) {
				$source = realpath(__DIR__ . '/fixtures/conditional-functions/' . $file);
				self::assertIsString($source);
				$files .= sprintf('<file name="%s" />', htmlspecialchars($source, ENT_XML1));
			}

			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><docpage target="%s">%s</docpage></mddoc>',
				htmlspecialchars($output, ENT_XML1),
				$files
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			self::assertStringContainsString('Function: \\conditionally_declared_function', $markdown);
			self::assertStringContainsString('Documents a conditionally declared function.', $markdown);
			self::assertStringContainsString('function conditionally_declared_function(string $value): string', $markdown);
			self::assertStringContainsString('Function: \\try_declared_function', $markdown);
			self::assertStringContainsString('Function: \\function_containing_declarations', $markdown);
			self::assertStringContainsString('Function: \\named_function_inside_function', $markdown);
			self::assertStringContainsString('Class: ClassInsideFunction', $markdown);
			self::assertStringContainsString('Function: \\named_function_inside_class_method', $markdown);
			self::assertStringContainsString('Class: ClassInsideClassMethod', $markdown);
			self::assertStringContainsString('Class: MDDocTest\\ConditionallyDeclaredClass', $markdown);
			self::assertStringContainsString('Enum: MDDocTest\\ConditionallyDeclaredEnum', $markdown);
			self::assertStringContainsString('Class: MDDocTest\\ConditionallyDeclaredInterface', $markdown);
			self::assertStringContainsString('Class: MDDocTest\\ConditionallyDeclaredTrait', $markdown);
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
