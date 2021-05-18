<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDom\CodeBlock;
use donatj\MDDom\Paragraph;

class ComposerInstall extends AbstractDocPart {

	public function output( int $depth ) {
		$file = realpath('composer.json');

		if( !is_readable($file) ) {
			throw new PathNotReadableException("Path not readable.", $file);
		}

		$data   = file_get_contents($file);
		$parsed = @json_decode($data, true);

		$para = new Paragraph;
		$para->appendChild(new \donatj\MDDom\Text($this->getOption('text') ?: 'Install the latest version with:'));
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

}
