<?php

use donatj\MDDoc\MDDoc;
use PHPUnit\Framework\TestCase;

class RecursiveDirectoryTest extends TestCase {

	public function testIgnoredFilesDoNotAddWhitespace() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-recursive-directory-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$hidden  = $tempDir . '/Hidden.php';
			$visible = $tempDir . '/Visible.php';
			$output  = $tempDir . '/README.md';
			$config  = $tempDir . '/mddoc.xml';

			self::assertNotFalse(file_put_contents($hidden, <<<'PHP'
<?php

namespace Example;

/** @mddoc-ignore */
class Hidden {
}
PHP
));

			self::assertNotFalse(file_put_contents($visible, <<<'PHP'
<?php

namespace Example;

class Visible {
}
PHP
));

			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><autoloader type="psr4" root="%s" namespace="Example" /><docpage target="%s"><recursive-directory name="%s" /></docpage></mddoc>',
				htmlspecialchars($tempDir, ENT_XML1),
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($tempDir, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			$heading = 'Class: Example\\Visible';
			self::assertStringContainsString($heading, $markdown);
			self::assertStringNotContainsString('<a id=', $markdown);
			self::assertDoesNotMatchRegularExpression('/\\n{3,}#+ ' . preg_quote($heading, '/') . '/', $markdown);
		} finally {
			foreach( [ $hidden ?? null, $visible ?? null, $config ?? null, $output ?? null ] as $file ) {
				if( $file !== null && file_exists($file) ) {
					unlink($file);
				}
			}

			rmdir($tempDir);
		}
	}

	public function testTableOfContentsUsesExplicitAnchors() : void {
		$tempDir = sys_get_temp_dir() . '/mddoc-table-of-contents-' . uniqid('', true);
		self::assertTrue(mkdir($tempDir, 0700));

		try {
			$class  = $tempDir . '/Widget.php';
			$iface  = $tempDir . '/WidgetContract.php';
			$output = $tempDir . '/README.md';
			$config = $tempDir . '/mddoc.xml';

			self::assertNotFalse(file_put_contents($class, <<<'PHP'
<?php

namespace Example;

class Widget {

	/** Render the widget. */
	public function render() : void {
	}

	/** Build a widget. */
	public static function build() : self {
		return new self;
	}

}
PHP
));

			self::assertNotFalse(file_put_contents($iface, <<<'PHP'
<?php

namespace Example;

interface WidgetContract {

	/** Render the widget. */
	public function render() : void;

}
PHP
));

			self::assertNotFalse(file_put_contents($config, sprintf(
				'<mddoc><docpage target="%s"><recursive-directory table-of-contents="true" name="%s" /></docpage></mddoc>',
				htmlspecialchars($output, ENT_XML1),
				htmlspecialchars($tempDir, ENT_XML1)
			)));

			new MDDoc([ 'mddoc', $config ]);

			$markdown = file_get_contents($output);
			self::assertIsString($markdown);
			foreach( [
				'# Table of Contents',
				'- [class Example\\Widget](#mddoc-class-example-widget)',
				'    - [function render](#mddoc-method-example-widget-render)',
				'    - [function build](#mddoc-method-example-widget-build)',
				'- [interface Example\\WidgetContract](#mddoc-interface-example-widgetcontract)',
				'    - [function render](#mddoc-method-example-widgetcontract-render)',
				'# <a id="mddoc-class-example-widget"></a>Class: Example\\Widget',
				'## <a id="mddoc-method-example-widget-render"></a>Method: Widget->render',
				'## <a id="mddoc-method-example-widget-build"></a>Method: Widget::build',
				'# <a id="mddoc-interface-example-widgetcontract"></a>Interface: Example\\WidgetContract',
				'## <a id="mddoc-method-example-widgetcontract-render"></a>Method: WidgetContract->render',
			] as $needle ) {
				self::assertStringContainsString($needle, $markdown);
			}

			$tableOfContentsPosition = strpos($markdown, '# Table of Contents');
			$classPosition            = strpos($markdown, '# <a id="mddoc-class-example-widget"></a>Class: Example\\Widget');
			self::assertIsInt($tableOfContentsPosition);
			self::assertIsInt($classPosition);
			self::assertLessThan($classPosition, $tableOfContentsPosition);
		} finally {
			foreach( [ $class ?? null, $iface ?? null, $config ?? null, $output ?? null ] as $file ) {
				if( $file !== null && file_exists($file) ) {
					unlink($file);
				}
			}

			rmdir($tempDir);
		}
	}

}
