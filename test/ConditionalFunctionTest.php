<?php

use donatj\MDDoc\MDDoc;
use donatj\MDDoc\Autoloaders\NullLoader;
use donatj\MDDoc\Reflectors\TaxonomyReflector;
use donatj\MDDoc\Reflectors\TaxonomyReflectorFactory;
use PHPUnit\Framework\TestCase;

class ConditionalFunctionTest extends TestCase {

	public function testDeclarationsInsideNestedStatementsAreDocumented() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-nested-declarations-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$output     = $tempDir . '/README.md';
			$config     = $tempDir . '/mddoc.xml';
			$sourceRoot = realpath(__DIR__ . '/fixtures/conditional-functions');
			$files      = '';

			self::assertIsString($sourceRoot);

			foreach( [ 'FunctionGuard.php', 'TryFunction.php', 'FunctionDeclarations.php', 'ClassMethodDeclarations.php', 'ClassGuard.php', 'EnumGuard.php', 'InterfaceGuard.php', 'TraitGuard.php', 'MultipleClasses.php', 'SameFileDependency/ParentClass.php', 'CrossFile/A.php' ] as $file ) {
				$source = realpath(__DIR__ . '/fixtures/conditional-functions/' . $file);
				self::assertIsString($source);
				$files .= sprintf('<file name="%s" />', htmlspecialchars($source, ENT_XML1));
			}

			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><autoloader type="psr4" root="%s" namespace="MDDocTest" /><docpage target="%s">%s</docpage></mddoc>',
				htmlspecialchars($sourceRoot, ENT_XML1),
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
			self::assertStringContainsString('Class: LocalClass', $markdown);
			self::assertStringContainsString('Method: LocalClass->localMethod', $markdown);
			self::assertStringContainsString('Class: MainClass', $markdown);
			self::assertStringContainsString('Method: MainClass->mainMethod', $markdown);
			self::assertStringContainsString('Class: MDDocTest\\SameFileDependency\\ChildClass', $markdown);
			self::assertStringContainsString('Method: ChildClass->parentMethod', $markdown);
			self::assertStringContainsString('Method: ChildClass->childMethod', $markdown);
			self::assertStringContainsString('Class: MDDocTest\\CrossFile\\Local', $markdown);
			self::assertStringContainsString('Method: Local->rootMethod', $markdown);
			self::assertStringContainsString('Method: Local->aMethod', $markdown);
			self::assertStringContainsString('Method: Local->bMethod', $markdown);
			self::assertStringContainsString('Method: Local->localMethod', $markdown);
		} finally {
			foreach( [ $config ?? null, $output ?? null ] as $file ) {
				if( $file !== null && file_exists($file) ) {
					unlink($file);
				}
			}

			rmdir($tempDir);
		}
	}

	public function testFirstClassReflectorPreservesSourceOrder() : void {
		$source = realpath(__DIR__ . '/fixtures/conditional-functions/ForwardDependency.php');
		self::assertIsString($source);

		$reflector = (new TaxonomyReflectorFactory)->newInstance($source, new NullLoader);
		$class = $reflector->getReflector();

		self::assertNotNull($class);
		self::assertSame('ChildClass', $class->getName());
	}

	public function testResolvingDependenciesReturnsANewReflector() : void {
		$source = realpath(__DIR__ . '/fixtures/conditional-functions/SameFileDependency/ParentClass.php');
		self::assertIsString($source);

		$factory = new TaxonomyReflectorFactory;
		$unresolved = new TaxonomyReflector($source, new NullLoader, $factory);
		$resolved = $unresolved->withResolvedDependencies();

		$unresolvedClass = $unresolved->getClass('MDDocTest\\SameFileDependency\\ChildClass');
		$resolvedClass = $resolved->getClass('MDDocTest\\SameFileDependency\\ChildClass');

		self::assertNotNull($unresolvedClass);
		self::assertNotNull($resolvedClass);
		self::assertArrayNotHasKey('parentMethod', $unresolvedClass->getMethods());
		self::assertArrayHasKey('parentMethod', $resolvedClass->getMethods());
	}

}
