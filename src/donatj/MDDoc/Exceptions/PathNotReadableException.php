<?php

namespace donatj\MDDoc\Exceptions;

class PathNotReadableException extends \Exception {

	protected $path;

	function __construct( $message, $path, \Exception $previous_exception = null ) {
		parent::__construct($message, 0, $previous_exception);

		$this->path = $path;
	}

	/**
	 * @return mixed
	 */
	public function getPath() {
		return $this->path;
	}

}
