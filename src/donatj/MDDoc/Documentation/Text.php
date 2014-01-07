<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Interfaces\DocInterface;

/**
 * Class Text
 *
 * @package donatj\MDDoc\Documentation
 */
class Text implements DocInterface {

	private $text;

	/**
	 * @param string $text
	 */
	function __construct( $text ) {
		$this->text = $text;
	}

	public function output( $depth ) {
		return trim($this->text) . "\n\n";
	}


}