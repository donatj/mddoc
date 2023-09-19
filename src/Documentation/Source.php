<?php

/**
 * Include a source code block either as a file or inline
 *
 * Example:
 *
 * ```xml
 * <source name="path/to/file.php" lang="php" />
 * <source lang="js">
 * console.log('Hello World');
 * </source>
 * ```
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDom\AbstractElement;
use donatj\MDDom\CodeBlock;

/**
 * Class Source
 */
class Source extends Text {

	/** filename of optional source file */
	public const OPT_NAME = 'name';
	/** Optional language name for the opening */
	public const OPT_LANG = 'lang';

	public function output( int $depth ) : AbstractElement {
		$name = $this->getOption(self::OPT_NAME);
		$lang = $this->getOption(self::OPT_LANG);

		$text = $this->getTextContent();
		if( $name ) {
			$file = $this->getWorkingFilePath($name);
			$text = file_get_contents($file);
		}

		return new CodeBlock($text, $lang);
	}

	public static function tagName() : string {
		return 'source';
	}

}
