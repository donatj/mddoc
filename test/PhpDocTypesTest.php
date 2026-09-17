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
				'function find(callable(string|int): bool $filter) : array<string,int>',
				'@var array{label: string,callback: callable(string|int): bool}',
				'***\\RuntimeException***',
				'***\\Psr\\Log\\LoggerInterface***',
				'function dnf((\\Countable&\\Iterator)|\\Stringable $value) : (\\Countable&\\Iterator)|\\Stringable',
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

}
