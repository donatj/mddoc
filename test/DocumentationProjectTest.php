<?php

use PHPUnit\Framework\TestCase;

class DocumentationProjectTest extends TestCase {

	public function testDocumentationProjectsExist() : void {
		self::assertNotSame([], self::projectDirectories());
	}

	/**
	 * @dataProvider documentationProjects
	 */
	public function testDocumentationProjectMatchesExpectedOutput( string $projectDirectory ) : void {
		$config = $projectDirectory . '/mddoc.xml';
		$target = $projectDirectory . '/README.md';

		self::assertFileExists($config);
		self::assertFileExists($target);

		$command = 'cd ' . escapeshellarg($projectDirectory) . ' && ' . implode(' ', [
			escapeshellarg(PHP_BINARY),
			escapeshellarg(__DIR__ . '/../composer/bin/mddoc'),
			'--dry-run=true',
			escapeshellarg($config),
		]) . ' 2>&1';

		exec($command, $output, $exitCode);

		self::assertSame(0, $exitCode, implode(PHP_EOL, $output));
	}

	/**
	 * @return array<string,array{string}>
	 */
	public static function documentationProjects() : array {
		$projects = [];
		foreach( self::projectDirectories() as $projectDirectory ) {
			$projects[basename($projectDirectory)] = [ $projectDirectory ];
		}

		return $projects;
	}

	/** @return string[] */
	private static function projectDirectories() : array {
		$projects = glob(__DIR__ . '/projects/*', GLOB_ONLYDIR);
		if( $projects === false ) {
			return [];
		}

		sort($projects);

		return $projects;
	}

}
