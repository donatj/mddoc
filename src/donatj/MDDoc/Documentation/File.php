<?php

namespace donatj\MDDoc\Documentation;

class File implements DocInterface {

	private $name;

	public function __construct( $name ) {
		$this->name = $name;
	}

	public function output( $depth ) {


		see($this->name, $depth);


	}

} 