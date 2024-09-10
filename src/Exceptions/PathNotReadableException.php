<?php

namespace donatj\MDDoc\Exceptions;

class PathNotReadableException extends MDDocException {

	/** @var string $path */
	protected $path;

	public function __construct( string $message, string $path, ?\Exception $previous_exception = null ) {
		parent::__construct($message, 0, $previous_exception);

		$this->path = $path;
	}

	public function getPath() : string {
		return $this->path;
	}

}
