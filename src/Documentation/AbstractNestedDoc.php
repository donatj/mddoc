<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Documentation\Interfaces\ElementInterface;

abstract class AbstractNestedDoc extends AbstractDocPart {

	/** @var \donatj\MDDoc\Documentation\Interfaces\ElementInterface[] */
	private $children = [];

	/**
	 * @return \donatj\MDDoc\Documentation\Interfaces\ElementInterface[]
	 */
	public function getChildren() : array {
		return $this->children;
	}

	/**
	 * @return \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]
	 */
	public function getDocumentationChildren() : array {
		$return = [];
		$children = $this->getChildren();

		foreach( $children as $child ) {
			if( $child instanceof DocumentationInterface ) {
				$return[] = $child;
			}
		}

		return $return;
	}

	public function addChildren( ElementInterface ...$children ) : void {
		foreach( $children as $child ) {
			$this->children[] = $child;
		}
	}

}
