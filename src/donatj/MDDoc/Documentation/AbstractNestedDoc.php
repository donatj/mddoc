<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Interfaces\DocInterface;

abstract class AbstractNestedDoc implements DocInterface {

	/**
	 * @var DocInterface[]
	 */
	private $children = array();

	/**
	 * @param DocInterface $child
	 */
	public function addChild( DocInterface $child ) {
		$this->children[] = $child;
	}

	/**
	 * @param \donatj\MDDoc\Interfaces\DocInterface[] $children
	 */
	public function setChildren( $children ) {
		foreach($children as $child) {
			$this->addChild($child);
		}
	}

	/**
	 * @return \donatj\MDDoc\Interfaces\DocInterface[]
	 */
	public function getChildren() {
		return $this->children;
	}

	/**
	 * @param string $input
	 */
	protected function cleanup($input) {
		return rtrim($input, "\n") . "\n\n";
	}


} 