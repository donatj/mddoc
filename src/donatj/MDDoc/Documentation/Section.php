<?php

namespace donatj\MDDoc\Documentation;

class Section extends AbstractNestedDoc {

	private $title;

	public function __construct( $title ) {
		$this->title = $title;
	}

	public function output( $depth ) {
		$output = str_repeat('#', $depth + 1) . " {$this->title}\n\n";

		foreach( $this->getChildren() as $child ) {
			$output .= $child->output($depth + 1);
		}

		return $output . "\n\n";
	}
}