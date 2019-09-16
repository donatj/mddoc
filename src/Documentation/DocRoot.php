<?php

namespace donatj\MDDoc\Documentation;

class DocRoot extends AbstractNestedDoc {

	public function output( int $depth ) {
		$output = '';
		foreach( $this->getChildren() as $child ) {
			$output .= $child->output($depth);
		}

		see(trim($output));
	}

	protected function init() {

	}

}
