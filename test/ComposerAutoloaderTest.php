<?php

use Composer\Autoload\ClassLoader;
use donatj\MDDoc\Autoloaders\ComposerAutoloader;
use donatj\MDDoc\MDDoc;
use PHPUnit\Framework\TestCase;

class ComposerAutoloaderTest extends TestCase {

	public function testComposerAutoloaderFindsClassesWithoutLoadingThem() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-composer-autoloader-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));
		self::assertTrue(mkdir($tempDir . '/src', 0700));
		self::assertTrue(mkdir($tempDir . '/legacy', 0700));
		self::assertTrue(mkdir($tempDir . '/vendor', 0700));

		try {
			$child    = $tempDir . '/src/Child.php';
			$parent   = $tempDir . '/src/ParentClass.php';
			$legacy   = $tempDir . '/legacy/Legacy/Class.php';
			$config   = $tempDir . '/mddoc.xml';
			$output   = $tempDir . '/README.md';

			self::assertTrue(mkdir(dirname($legacy), 0700));
			self::assertNotFalse(file_put_contents($child, <<<'PHP'
<?php

namespace Example;

class Child extends ParentClass {
}
PHP
));
			self::assertNotFalse(file_put_contents($parent, <<<'PHP'
<?php

namespace Example;

throw new \RuntimeException('This source file must not be loaded.');

class ParentClass {

	/** Inherited method. */
	public function inherited() {
	}

}
PHP
		));
			self::assertNotFalse(file_put_contents($legacy, "<?php\n"));

			$targetLoader = new ClassLoader($tempDir . '/vendor');
			$targetLoader->add('Legacy_', [ $tempDir . '/legacy' ]);
			$targetLoader->addPsr4('Example\\', [ $tempDir . '/src' ]);
			$targetLoader->register();

			$loader = new ComposerAutoloader($tempDir);
			self::assertSame($legacy, $loader('Legacy_Class'));

			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><docpage target="%s"><file name="%s" /></docpage></mddoc>',
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($child, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			self::assertStringContainsString('Class: Example\\Child', $markdown);
			self::assertStringContainsString('function inherited()', $markdown);
		} finally {
			if( isset($targetLoader) ) {
				$targetLoader->unregister();
			}

			foreach( [ $child ?? null, $parent ?? null, $legacy ?? null, $config ?? null, $output ?? null ] as $file ) {
				if( $file !== null && file_exists($file) ) {
					unlink($file);
				}
			}

			foreach( [ $tempDir . '/legacy/Legacy', $tempDir . '/legacy', $tempDir . '/src', $tempDir . '/vendor', $tempDir ] as $directory ) {
				if( is_dir($directory) ) {
					rmdir($directory);
				}
			}
		}
	}

}
