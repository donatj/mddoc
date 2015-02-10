<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDom\Document;
use donatj\MDDom\DocumentDepth;
use donatj\MDDom\Header;

class Section extends AbstractNestedDoc {

	public function output( $depth ) {
		$title = $this->getOption('title');

		if( $this->getParent() instanceof DocPage ) {
			$document = new Document();
		} else {
			$document = new DocumentDepth();
		}

		$document->appendChild(new Header($title));

		foreach( $this->getChildren() as $child ) {
			$document->appendChild($child->output($depth + 1));
		}

		return $document;
	}

	protected function init() {
		$this->requireOptions('title');
	}

}