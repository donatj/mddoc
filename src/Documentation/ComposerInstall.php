<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDom\CodeBlock;
use donatj\MDDom\Paragraph;

class ComposerInstall extends AbstractDocPart {

	public function output( int $depth ) : Paragraph {
		$file = $this->getWorkingFilePath('composer.json');

		$data   = file_get_contents($file);
		$parsed = @json_decode($data, true);

		$para = new Paragraph;
		$text = $this->getOption('text') ?? 'Install the latest version with:';
		if( $text ) {
			$para->appendChild($text);
		}

		$install = 'composer ';
		if( $this->getOption('global') == 'true' ) {
			$install .= 'global ';
		}

		$install .= 'require ';
		if( $this->getOption('dev') == 'true' ) {
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
