<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\PathNotReadableException;

class IncludeFile extends AbstractDocPart {

	/**
	 * @param int $depth
	 * @return string
	 * @throws \donatj\MDDoc\Exceptions\PathNotReadableException
	 */
	public function output( $depth ) {
		$this->requireOptions('name');
		$name = $this->getOption('name');

		if( !is_readable($name) ) {
			throw new PathNotReadableException("{$name} not readable.");
		}

		return file_get_contents($name) . "\n\n";
	}

}
