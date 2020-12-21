<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Runner\ImmutableAttributeTree;

abstract class AbstractDocPart implements DocumentationInterface {

	protected $defaults = [];
	protected $options;
	protected $treeOptions;

	/**
	 * @var AbstractDocPart
	 */
	protected $parent;
	/**
	 * @var \donatj\MDDoc\Runner\ImmutableAttributeTree
	 */
	protected $attributeTree;

	public function __construct( ImmutableAttributeTree $attributeTree, array $options, array $tree_options ) {
		$this->attributeTree = $attributeTree;
		$this->options       = $options;
		$this->treeOptions   = $tree_options;

		$this->init();
	}

	abstract protected function init() : void;


	public function setOptionDefault( string $key, $value ) : void {
		$this->defaults[$key] = $value;
	}

	public function getOption( string $key, bool $tree = false ) : ?string {
		$data = $tree ? $this->treeOptions : $this->options;

		return $data[$key] ??
			   ($this->defaults[$key] ?? null);
	}

	/**
	 * @param array|string $options
	 * @throws \donatj\MDDoc\Exceptions\ConfigException
	 */
	protected function requireOptions( $options, bool $tree = false ) : void {

		$tree ? $this->treeOptions : $this->options;

		$options = (array)$options;
		foreach( $options as $key ) {
			if( $this->getOption($key) === null ) {
				throw new ConfigException(get_called_class() . " requires {$key} attribute.");
			}
		}
	}

	public function setParent( AbstractDocPart $parent ) : void {
		$this->parent = $parent;
	}

	public function getParent() : ?AbstractDocPart {
		return $this->parent;
	}

}
