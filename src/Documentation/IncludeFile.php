<?php

/**
 * Include the contents of a file
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDom\Paragraph;

class IncludeFile extends AbstractDocPart {

	/**
	 * The poth of the file to include
	 *
	 * @mddoc-required
	 */
	public const OPT_NAME = 'name';

	/**
	 * @throws \donatj\MDDoc\Exceptions\PathNotReadableException
	 */
	public function output( int $depth ) : Paragraph {
		$name = $this->getOption(self::OPT_NAME);
		$file = $this->getWorkingFilePath($name);

		return new Paragraph(file_get_contents($file));
	}

	protected function init() : void {
		$this->requireOption(self::OPT_NAME);
	}

	public static function tagName() : string {
		return 'include';
	}

}
