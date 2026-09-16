<?php

require __DIR__ . '/../vendor/autoload.php';

use donatj\MDDoc\MDDoc;

$tempDir = sys_get_temp_dir() . '/mddoc-recursive-directory-' . uniqid('', true);
if( !mkdir($tempDir, 0700) ) {
	throw new RuntimeException('Failed to create temporary test directory');
}

try {
	$hidden = $tempDir . '/Hidden.php';
	$visible = $tempDir . '/Visible.php';
	$output = $tempDir . '/README.md';
	$config = $tempDir . '/mddoc.xml';

	file_put_contents($hidden, <<<'PHP'
<?php

namespace Example;

/** @mddoc-ignore */
class Hidden {
}
PHP
);

	file_put_contents($visible, <<<'PHP'
<?php

namespace Example;

class Visible {
}
PHP
);

	file_put_contents($config, sprintf(
		'<mddoc><autoloader type="psr4" root="%s" namespace="Example" /><docpage target="%s"><recursive-directory name="%s" /></docpage></mddoc>',
		htmlspecialchars($tempDir, ENT_XML1),
		htmlspecialchars($output, ENT_XML1),
		htmlspecialchars($tempDir, ENT_XML1)
	));

	new MDDoc([ 'mddoc', $config ]);

	$markdown = file_get_contents($output);
	$heading = 'Class: Example\\Visible';
	if( strpos($markdown, $heading) === false ) {
		throw new RuntimeException('Expected the visible class to be documented');
	}

	if( preg_match('/\\n{3,}#+ ' . preg_quote($heading, '/') . '/', $markdown) ) {
		throw new RuntimeException('Ignored files must not add whitespace before the next documented class');
	}
} finally {
	foreach( [ $hidden ?? null, $visible ?? null, $config ?? null, $output ?? null ] as $file ) {
		if( $file && file_exists($file) ) {
			unlink($file);
		}
	}

	rmdir($tempDir);
}
