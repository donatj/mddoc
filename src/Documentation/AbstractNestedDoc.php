<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;

abstract class AbstractNestedDoc extends AbstractDocPart {

	/** @var \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[] */
	private $children = [];

	/**
	 * @return \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]
	 */
	public function getChildren() : array {
		return $this->children;
	}

	public function addChildren( DocumentationInterface ...$children ) : void {
		foreach($children as $child) {
			$this->children[] = $child;
		}
	}

}
