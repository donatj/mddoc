<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;

/**
 * Class Text
 *
 * @package donatj\MDDoc\Documentation
 */
class Text implements DocumentationInterface {

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