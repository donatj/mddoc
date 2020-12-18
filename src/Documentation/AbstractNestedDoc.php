<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;

abstract class AbstractNestedDoc extends AbstractDocPart {

	/**
	 * @var \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]
	 */
	private $children = [];

	/**
	 * @return \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]
	 */
	public function getChildren() : array {
		return $this->children;
	}

	/**
	 * @param \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[] $children
	 */
	public function setChildren( $children ) {
		foreach( $children as $child ) {
			$this->addChild($child);
		}
	}

	public function addChild( DocumentationInterface $child ) : void {
		$this->children[] = $child;
	}

}
