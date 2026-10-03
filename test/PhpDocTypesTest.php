<?php

use donatj\MDDoc\MDDoc;
use PHPUnit\Framework\TestCase;

class PhpDocTypesTest extends TestCase {

	public function testModernPhpDocTypesAreDocumented() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-phpdoc-types-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$output        = $tempDir . '/README.md';
			$source        = realpath(__DIR__ . '/fixtures/phpdoc-types/ModernTypes.php');
			$globalImports = realpath(__DIR__ . '/fixtures/phpdoc-types/GlobalImports.php');
			$config        = $tempDir . '/mddoc.xml';

			self::assertIsString($source);
			self::assertIsString($globalImports);
			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><docpage target="%s"><file name="%s" /><file name="%s" /></docpage></mddoc>',
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($source, ENT_XML1),
				htmlspecialchars($globalImports, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			foreach( [
				'***string[]*** `$names`',
				'***callable(string|int): bool*** `$filter`',
				'***callable(string $value,int ...$values): bool*** `$formatter`',
				'***array{items: list<string>,count: positive-int}***',
				'***(string|int)[]*** `$compound`',
				'***iterable<covariant string,contravariant int,*>*** `$variance`',
				'***\\Psr\\Log\\LoggerInterface<string>*** `$loggers`',
				'***T*** `$template`',
				'***Item*** `$item`',
				'***array-key*** `$key`',
				'***ExternalItem*** `$external`',
				'***ImportedItem*** `$imported`',
				'***\\Countable&(\\Iterator|\\Stringable)*** `$intersection`',
				'***(\\Countable&\\Iterator)*** | ***\\Stringable*** `$union`',
				'***?(\\Countable|\\Iterator)*** `$nullable`',
				'**Throws**: `\\RuntimeException`',
				'function nativeReturn(): int',
				'function find(callable(string|int): bool $filter): array<string,int>',
				"function multiLineMagicSignature(\n\t\\DateTimeImmutable \$createdAt,\n\t\\DateTimeImmutable \$updatedAt,\n\t\\DateTimeImmutable \$publishedAt,\n\t\\DateTimeImmutable \$archivedAt,\n): \\DateTimeImmutable",
				"function multiLineCallableMagicSignature(\n\tcallable(string,int): bool \$filter,\n\t\\DateTimeImmutable \$createdAt,\n\t\\DateTimeImmutable \$updatedAt,\n\t\\DateTimeImmutable \$publishedAt,\n): \\DateTimeImmutable",
				"function optionalParameters(\n\tstring \$required,\n\tint \$count = 1,\n\t?string \$label = \\null,\n)",
				'@var array{label: string,callback: callable(string|int): bool}',
				'***\\RuntimeException***',
				'***\\Psr\\Log\\LoggerInterface***',
				"function dnf(\n\t(\\Countable&\\Iterator)|\\Stringable \$value,\n): (\\Countable&\\Iterator)|\\Stringable",
				"function multiLineSignature(\n\t\\DateTimeImmutable \$createdAt,\n\t\\DateTimeImmutable \$updatedAt,\n\t\\DateTimeImmutable \$publishedAt,\n\t\\DateTimeImmutable \$archivedAt,\n): \\DateTimeImmutable",
				"function multiLineDefaultSignature(\n\tarray \$labels = ['first', 'second'],\n\t\\DateTimeImmutable \$createdAt,\n\t\\DateTimeImmutable \$updatedAt,\n\t\\DateTimeImmutable \$publishedAt,\n): \\DateTimeImmutable",
				"function aMethodWithAnIntentionallyLongNameThatStillRequiresWrappingEvenThoughItDoesNotHaveAnyParametersAtAll(\n): \\DateTimeImmutable",
				'function variadicSignature(string ...$values): void',
				'### Parameters',
				'### Return Value',
				'## Method: ModernTypes->undocumented',
				"function undocumented(string \$name = ''): string\n```\n\nUndocumented",
			] as $needle ) {
				self::assertStringContainsString($needle, $markdown);
			}

			self::assertStringNotContainsString('Undocumented Method:', $markdown);
			self::assertStringNotContainsString('### Parameters:', $markdown);
			self::assertStringNotContainsString('### Returns:', $markdown);
		} finally {
			foreach( [ $config ?? null, $output ?? null ] as $file ) {
				if( $file !== null && file_exists($file) ) {
					unlink($file);
				}
			}

			rmdir($tempDir);
		}
	}

	public function testSignatureWrapLengthCanBeConfiguredOrDisabled() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-signature-wrap-length-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$output = $tempDir . '/README.md';
			$source = realpath(__DIR__ . '/fixtures/phpdoc-types/GlobalImports.php');
			$config = $tempDir . '/mddoc.xml';

			self::assertIsString($source);
			foreach( [ 120, 0 ] as $wrapLength ) {
				self::assertNotFalse(file_put_contents($config, sprintf(
					'<mddoc><docpage target="%s"><file name="%s" signature-wrap-length="%d" /></docpage></mddoc>',
					htmlspecialchars($output, ENT_XML1),
					htmlspecialchars($source, ENT_XML1),
					$wrapLength
				)));

				new MDDoc([ 'mddoc', $config ]);

				$markdown = file_get_contents($output);
				self::assertIsString($markdown);
				self::assertStringContainsString('function optionalParameters(string $required, int $count = 1, ?string $label = \\null)', $markdown);
				self::assertStringNotContainsString("function optionalParameters(\n", $markdown);
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

	public function testUndocumentedMethodWarningCanBeDisabled() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-undocumented-method-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$output = $tempDir . '/README.md';
			$source = realpath(__DIR__ . '/fixtures/phpdoc-types/ModernTypes.php');
			$config = $tempDir . '/mddoc.xml';

			self::assertIsString($source);
			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><docpage target="%s"><file name="%s" warn-undocumented="false" /></docpage></mddoc>',
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($source, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			self::assertStringContainsString('## Method: ModernTypes->undocumented', $markdown);
			self::assertStringContainsString("function undocumented(string \$name = ''): string\n```", $markdown);
			self::assertStringNotContainsString('Undocumented', $markdown);
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
