<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDom\Paragraph;

class ComposerRequires extends AbstractDocPart {

	public function output( $depth ) {
		$file = realpath('composer.json');

		if( !is_readable($file) ) {
			throw new PathNotReadableException("Path not readable.", $file);
		}

		$data   = file_get_contents($file);
		$parsed = @json_decode($data, true);

		$para = new Paragraph();
		foreach( $parsed['require'] as $field => $version ) {
			$para->appendChild(new \donatj\MDDom\Text("- **$field**: $version"));
		}

		return $para;
	}

	protected function init() { }

}
