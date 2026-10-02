<?php

namespace donatj\MDDoc\Exceptions;

class DryRunMismatchException extends MDDocException {

	private string $target;

	public function __construct( string $target ) {
		parent::__construct('Dry run output differs');

		$this->target = $target;
	}

	public function getTarget() : string {
		return $this->target;
	}

}
