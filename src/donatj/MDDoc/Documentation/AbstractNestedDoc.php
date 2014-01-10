<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;

abstract class AbstractNestedDoc extends AbstractDocPart {

	/**
	 * @var \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]
	 */
	private $children = array();

	/**
	 * @return \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]
	 */
	public function getChildren() {
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

	/**
	 * @param \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface $child
	 */
	public function addChild( DocumentationInterface $child ) {
		$this->children[] = $child;
	}

	/**
	 * @param $input
	 * @return string
	 */
	protected function cleanup( $input ) {
		return rtrim($input, "\n") . "\n\n";
	}


} 