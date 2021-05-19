<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Runner\ImmutableAttributeTree;

abstract class AbstractDocPart implements DocumentationInterface {

	protected $defaults = [];

	/** @var AbstractDocPart */
	protected $parent;
	/** @var \donatj\MDDoc\Runner\ImmutableAttributeTree */
	protected $attributeTree;

	public function __construct( ImmutableAttributeTree $attributeTree ) {
		$this->attributeTree = $attributeTree;
		$this->init();
	}

	abstract protected function init() : void;

	public function setOptionDefault( string $key, ?string $value ) : void {
		$this->defaults[$key] = $value;
	}

	public function getOption( string $key, bool $tree = false ) : ?string {
		if( $tree ) {
			return $this->attributeTree->deepValue($key) ?? $this->defaults[$key] ?? null;
		}

		return $this->attributeTree->shallowValue($key) ?? $this->defaults[$key] ?? null;
	}

	/**
	 * @throws \donatj\MDDoc\Exceptions\ConfigException
	 */
	protected function requireOption( string $key, bool $tree = false ) : void {
		if( $this->getOption($key, $tree) === null ) {
			throw new ConfigException(static::class . " requires {$key} attribute.");
		}
	}

	public function setParent( AbstractDocPart $parent ) : void {
		$this->parent = $parent;
	}

	public function getParent() : ?AbstractDocPart {
		return $this->parent;
	}

}
