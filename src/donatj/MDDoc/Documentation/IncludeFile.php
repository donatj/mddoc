<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\PathNotReadableException;

class IncludeFile extends AbstractDocPart {

	/**
	 * @param int $depth
	 * @return string
	 * @throws \donatj\MDDoc\Exceptions\PathNotReadableException
	 */
	public function output( $depth ) {
		$name = $this->getOption('name');

		if( !is_readable($name) ) {
			throw new PathNotReadableException("{$name} not readable.");
		}

		return file_get_contents($name) . "\n\n";
	}

	protected function init() {
		$this->requireOptions('name');
	}

}
