<?php

namespace donatj\MDDoc\Documentation;

abstract class AbstractNestedDoc implements DocInterface {

	/**
	 * @var DocInterface[]
	 */
	private $children;

	/**
	 * @param DocInterface $child
	 */
	public function addChild( DocInterface $child ) {
		$children[] = $child;
	}

	/**
	 * @param \donatj\MDDoc\Documentation\DocInterface[] $children
	 */
	public function setChildren( $children ) {
		foreach($children as $child) {
			$this->addChild($child);
		}
	}

	/**
	 * @return \donatj\MDDoc\Documentation\DocInterface[]
	 */
	public function getChildren() {
		return $this->children;
	}



} 