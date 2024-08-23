<?php

/**
 * Reads the current projects' composer.json file and outputs the required packages, versions and extensions
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDom\Paragraph;

class ComposerRequires extends AbstractDocPart {

	public function output( int $depth ) : Paragraph {
		$file = $this->getWorkingFilePath('composer.json');

		$data = @file_get_contents($file);
		if( $data === false ) {
			throw new PathNotReadableException('Unable to read composer.json', $file);
		}

		$parsed = @json_decode($data, true);

		$para = new Paragraph;
		if( isset($parsed['require']) && is_array($parsed['require']) ) {
			foreach( $parsed['require'] as $field => $version ) {
				$para->appendChild(new \donatj\MDDom\Text("- **$field**: $version\n"));
			}
		}

		return $para;
	}

	protected function init() : void { }

	public static function tagName() : string {
		return 'composer-requires';
	}

}
