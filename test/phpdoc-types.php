<?php

require __DIR__ . '/../vendor/autoload.php';

use donatj\MDDoc\MDDoc;

$tempDir = sys_get_temp_dir() . '/mddoc-phpdoc-types-' . uniqid('', true);
if( !mkdir($tempDir, 0700) ) {
	throw new RuntimeException('Failed to create temporary test directory');
}

try {
	$output = $tempDir . '/README.md';
	$source = realpath(__DIR__ . '/fixtures/phpdoc-types/ModernTypes.php');
	$globalImports = realpath(__DIR__ . '/fixtures/phpdoc-types/GlobalImports.php');
	$config = $tempDir . '/mddoc.xml';

	file_put_contents($config, sprintf(
		'<mddoc><docpage target="%s"><file name="%s" /><file name="%s" /></docpage></mddoc>',
		htmlspecialchars($output, ENT_XML1),
		htmlspecialchars($source, ENT_XML1),
		htmlspecialchars($globalImports, ENT_XML1)
	));

	new MDDoc([ 'mddoc', $config ]);

	$markdown = file_get_contents($output);
	$expected = [
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
	];

	foreach( $expected as $needle ) {
		if( strpos($markdown, $needle) === false ) {
			throw new RuntimeException("Expected generated markdown to contain: {$needle}");
		}
	}
} finally {
	if( isset($config) && file_exists($config) ) {
		unlink($config);
	}

	if( isset($output) && file_exists($output) ) {
		unlink($output);
	}

	rmdir($tempDir);
}
