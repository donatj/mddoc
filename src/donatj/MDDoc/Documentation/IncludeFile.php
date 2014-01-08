<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\PathNotReadableException;

class IncludeFile implements DocumentationInterface {

	protected $name;

	function __construct( $name ) {
		if( !is_readable($name) ) {
			throw new PathNotReadableException("{$name} not readable.");
		}

		$this->name = $name;
	}

	/**
	 * @param int $depth
	 * @return string
	 */
	public function output( $depth ) {
		return file_get_contents($this->name) . "\n\n";
	}

}
