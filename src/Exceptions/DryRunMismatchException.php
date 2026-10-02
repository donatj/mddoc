<?php

namespace donatj\MDDoc\Exceptions;

class DryRunMismatchException extends MDDocException {

	public function __construct( string $target ) {
		parent::__construct("output '{$target}' differs");
	}

}
