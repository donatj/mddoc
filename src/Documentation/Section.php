<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDom\DocumentDepth;
use donatj\MDDom\Header;

class Section extends AbstractNestedDoc {

	public function output( int $depth ) : DocumentDepth {
		$title = $this->getOption('title');

		$document = new DocumentDepth;
		$document->appendChild(new Header($title));

		foreach( $this->getChildren() as $child ) {
			$document->appendChild($child->output($depth + 1));
		}

		return $document;
	}

	protected function init() : void {
		$this->requireOption('title');
	}

}
