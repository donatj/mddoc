<?php

namespace donatj\MDDoc\Documentation;

class DocRoot extends AbstractNestedDoc {

	public function __construct() {
		// TODO: Implement __construct() method.
	}

	public function output( $depth = 0 ) {
		$output = '';
		foreach($this->getChildren() as $child) {
			$output .= $child->output($depth);
		}

		see(trim($output));
	}

}