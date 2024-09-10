<?php

namespace donatj\MDDoc\Documentation;

class DocRoot extends AbstractNestedDoc {

	public function output( int $depth ) {
		// $output = '';
		foreach( $this->getDocumentationChildren() as $child ) {
			// $output .=
			$child->output($depth);
		}
	}

	protected function init() : void {

	}

	public static function tagName() : string {
		return 'doc-root';
	}

}
