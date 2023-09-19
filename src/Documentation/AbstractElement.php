<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Runner\ImmutableAttributeTree;

abstract class AbstractElement implements Interfaces\ElementInterface {

	/** @var AbstractDocPart */
	private $parent;
	/** @var array<string,?string> */
	private $defaults = [];
	private $textContent;
	/** @var \donatj\MDDoc\Runner\ImmutableAttributeTree */
	private $attributeTree;

	public function __construct( ImmutableAttributeTree $attributeTree, string $textContent = '' ) {
		$this->attributeTree = $attributeTree;
		$this->textContent = $textContent;
	}

	/**
	 * @internal
	 */
	public function setParent( AbstractDocPart $parent ) : void {
		$this->parent = $parent;
	}

	public function getParent() : ?AbstractDocPart {
		return $this->parent;
	}

	public function getTextContent() : string {
		return $this->textContent;
	}

	protected function setOptionDefault( string $key, ?string $value ) : void {
		$this->defaults[$key] = $value;
	}

	protected function getAttributeTree() : ImmutableAttributeTree {
		return $this->attributeTree;
	}

	/**
	 * @throws \donatj\MDDoc\Exceptions\ConfigException
	 */
	protected function requireOption( string $key, bool $tree = false ) : string {
		$option = $this->getOption($key, $tree);
		if( $option === null ) {
			throw new ConfigException(static::class . " requires {$key} attribute.");
		}

		return $option;
	}

	protected function getOption( string $key, bool $tree = false ) : ?string {
		if( $tree ) {
			return $this->attributeTree->deepValue($key) ?? $this->defaults[$key] ?? null;
		}

		return $this->attributeTree->shallowValue($key) ?? $this->defaults[$key] ?? null;
	}

}
