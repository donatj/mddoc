<?php

use donatj\MDDoc\MDDoc;
use PHPUnit\Framework\TestCase;

class InheritedDescriptionsTest extends TestCase {

	public function testInheritedDescriptionsAreBlockQuotes() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-inherited-descriptions-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$child      = $tempDir . '/Child.php';
			$parent     = $tempDir . '/ParentType.php';
			$grandparent = $tempDir . '/GrandparentType.php';
			$config     = $tempDir . '/mddoc.xml';
			$output     = $tempDir . '/README.md';

			self::assertNotFalse(file_put_contents($child, <<<'PHP'
<?php

namespace Example;

class Child extends ParentType {
}
PHP
));
			self::assertNotFalse(file_put_contents($parent, <<<'PHP'
<?php

namespace Example;

class ParentType extends GrandparentType {

	/** Parent method description. */
	public function inherited() {
	}

}
PHP
));
			self::assertNotFalse(file_put_contents($grandparent, <<<'PHP'
<?php

namespace Example;

class GrandparentType {

	/** Grandparent method description. */
	public function inherited() {
	}

}
PHP
));
			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><autoloader type="psr4" root="%s" namespace="Example" /><docpage target="%s"><file name="%s" /></docpage></mddoc>',
				htmlspecialchars($tempDir, ENT_XML1),
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($child, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			self::assertStringContainsString('> *Inherited from*: `\\Example\\ParentType`', $markdown);
			self::assertStringContainsString('> Parent method description.', $markdown);
			self::assertStringContainsString('> *Inherited from*: `\\Example\\GrandparentType`', $markdown);
			self::assertStringContainsString('> Grandparent method description.', $markdown);
			self::assertStringNotContainsString('> > ', $markdown);
		} finally {
			foreach( [ $child ?? null, $parent ?? null, $grandparent ?? null, $config ?? null, $output ?? null ] as $file ) {
				if( $file !== null && file_exists($file) ) {
					unlink($file);
				}
			}

			rmdir($tempDir);
		}
	}

}
