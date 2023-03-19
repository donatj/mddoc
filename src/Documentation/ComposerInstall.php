<?php

/**
 * Reads the current projects' composer.json file and outputs the install command
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDom\CodeBlock;
use donatj\MDDom\Paragraph;

class ComposerInstall extends AbstractDocPart {

	/** Text to display before the install command */
	public const OPT_TEXT = 'text';

	/** Whether to include global subcommand */
	public const OPT_GLOBAL = 'global';

	/** Whether to include --dev flag */
	public const OPT_DEV = 'dev';

	public function output( int $depth ) : Paragraph {
		$file = $this->getWorkingFilePath('composer.json');

		$data   = file_get_contents($file);
		$parsed = @json_decode($data, true);

		$para = new Paragraph;
		$text = $this->getOption(self::OPT_TEXT) ?? 'Install the latest version with:';
		if( $text ) {
			$para->appendChild($text);
		}

		$install = 'composer ';
		if( $this->getOption(self::OPT_GLOBAL) == 'true' ) {
			$install .= 'global ';
		}

		$install .= 'require ';
		if( $this->getOption(self::OPT_DEV) == 'true' ) {
			$install .= '--dev ';
		}

		$install .= escapeshellarg($parsed['name']);
		$para->appendChild(new CodeBlock($install, 'bash'));

		return $para;
	}

	protected function init() : void { }

	public static function tagName() : string {
		return 'composer-install';
	}

}
