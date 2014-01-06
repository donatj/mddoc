<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\TargetNotWritableException;

class Docpage extends AbstractNestedDoc {

	private $target;

	function __construct( $depth, $target ) {

		if( (is_file($target) && !is_writable($target)) || !touch($target) ) {
			throw new TargetNotWritableException($target . ' not writable');
		}

	}

	public function getMarkdown() {
		// TODO: Implement getMarkdown() method.
	}
}