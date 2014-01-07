<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDoc\Interfaces\DocInterface;

class IncludeFile implements DocInterface {

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
