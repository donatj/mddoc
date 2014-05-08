<?php

namespace donatj\MDDoc\Documentation;

/**
 * Class Text
 *
 * @package donatj\MDDoc\Documentation
 */
class Text extends AbstractDocPart {

	protected $text;

	public function __construct( array $options, array $tree_options, $text = '' ) {
		$this->text = $text;
		parent::__construct($options, $tree_options);
	}

	public function output( $depth ) {
		return trim($this->text) . "\n\n";
	}

	protected function init() { }

}