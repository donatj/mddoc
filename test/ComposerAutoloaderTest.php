<?php

use Composer\Autoload\ClassLoader;
use donatj\MDDoc\Autoloaders\ComposerAutoloader;
use donatj\MDDoc\ElementFactory;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\MDDoc;
use donatj\MDDoc\Runner\ConfigParser;
use donatj\MDDoc\Runner\TextUI;
use PHPUnit\Framework\TestCase;

class ComposerAutoloaderTest extends TestCase {

	public function testConfigUsesDeclaredComposerAutoloader() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-composer-autoloader-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));
		self::assertTrue(mkdir($tempDir . '/src', 0700));
		self::assertTrue(mkdir($tempDir . '/legacy', 0700));
		self::assertTrue(mkdir($tempDir . '/secondary', 0700));

		try {
			$child           = $tempDir . '/src/Child.php';
			$parent          = $tempDir . '/src/ParentClass.php';
			$legacy          = $tempDir . '/legacy/Legacy/Class.php';
			$secondaryChild  = $tempDir . '/secondary/Child.php';
			$secondaryParent = $tempDir . '/secondary/ParentClass.php';
			$config          = $tempDir . '/mddoc.xml';
			$output          = $tempDir . '/README.md';
			$autoload        = $tempDir . '/vendor/autoload.php';
			$vendorLink      = $tempDir . '/vendor-link';

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
			self::assertNotFalse(file_put_contents($secondaryChild, <<<'PHP'
<?php

namespace Secondary;

class Child extends ParentClass {
}
PHP
));
			self::assertNotFalse(file_put_contents($secondaryParent, <<<'PHP'
<?php

namespace Secondary;

class ParentClass {

	/** Secondary inherited method. */
	public function secondaryInherited() {
	}

}
PHP
));
			self::assertNotFalse(file_put_contents($legacy, "<?php\n"));
			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><docpage target="%s"><autoloader type="composer"/><file name="%s" /></docpage></mddoc>',
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($child, ENT_XML1)
			)));

			$ui     = new TextUI(STDOUT, STDERR);
			$parser = new ConfigParser(new ElementFactory($ui), $ui);
			try {
				$parser->parse($config);
				self::fail('Expected unavailable Composer autoloader to fail.');
			} catch( ConfigException $exception ) {
				self::assertSame('Composer autoloader unavailable for config project', $exception->getMessage());
			}

			self::assertTrue(mkdir($tempDir . '/vendor', 0700));
			self::assertTrue(symlink($tempDir . '/vendor', $vendorLink));

			$targetLoader = new ClassLoader($tempDir . '/vendor');
			$targetLoader->add('Legacy_', [ $tempDir . '/legacy' ]);
			$targetLoader->addPsr4('Example\\', [ $tempDir . '/src' ]);
			$targetLoader->register();
			$secondaryLoader = new ClassLoader($vendorLink);
			$secondaryLoader->addPsr4('Secondary\\', [ $tempDir . '/secondary' ]);
			$secondaryLoader->register();

			$loader = new ComposerAutoloader($targetLoader);
			self::assertSame($legacy, $loader('Legacy_Class'));

			self::assertNotFalse(file_put_contents($autoload, "<?php\n"));
			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><docpage target="%s"><file name="%s" /></docpage></mddoc>',
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($child, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);
			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			self::assertStringNotContainsString('function inherited()', $markdown);

			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><docpage target="%s"><autoloader type="composer"/><file name="%s" /><file name="%s" /></docpage></mddoc>',
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($child, ENT_XML1),
				htmlspecialchars($secondaryChild, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			self::assertStringContainsString('Class: Example\\Child', $markdown);
			self::assertStringContainsString('function inherited()', $markdown);
			self::assertStringContainsString('Class: Secondary\\Child', $markdown);
			self::assertStringContainsString('function secondaryInherited()', $markdown);
		} finally {
			if( isset($secondaryLoader) ) {
				$secondaryLoader->unregister();
			}

			if( isset($targetLoader) ) {
				$targetLoader->unregister();
			}

			foreach( [ $child ?? null, $parent ?? null, $legacy ?? null, $secondaryChild ?? null, $secondaryParent ?? null, $config ?? null, $output ?? null, $autoload ?? null, $vendorLink ?? null ] as $file ) {
				if( $file !== null && file_exists($file) ) {
					unlink($file);
				}
			}

			foreach( [ $tempDir . '/legacy/Legacy', $tempDir . '/legacy', $tempDir . '/secondary', $tempDir . '/src', $tempDir . '/vendor', $tempDir ] as $directory ) {
				if( is_dir($directory) ) {
					rmdir($directory);
				}
			}
		}
	}

}
