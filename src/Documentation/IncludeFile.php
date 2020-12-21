<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDom\Paragraph;

class IncludeFile extends AbstractDocPart {

	/**
	 * @return Paragraph
	 * @throws \donatj\MDDoc\Exceptions\PathNotReadableException
	 */
	public function output( int $depth ) {
		$name = $this->getOption('name');

		if( !is_readable($name) ) {
			throw new PathNotReadableException("Path not readable.", $name);
		}

		return new Paragraph(file_get_contents($name));
	}

	protected function init() : void {
		$this->requireOption('name');
	}

}
