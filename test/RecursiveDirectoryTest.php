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

}
