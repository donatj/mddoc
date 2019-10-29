<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\ConfigException;

abstract class AbstractDocPart implements DocumentationInterface {

	/**
	 * This variable is the funk
	 *
	 * @var bool
	 */
	public $removeMe = true;

	protected $defaults = [];
	protected $options;
	protected $treeOptions;

	/**
	 * @var AbstractDocPart
	 */
	protected $parent = null;

	public function __construct( array $options, array $tree_options ) {
		$this->setOptions($options, $tree_options);

		$this->init();
	}

	abstract protected function init();

	public function setOptions( array $options, array $tree_options ) {
		$this->options     = $options;
		$this->treeOptions = $tree_options;
	}

	/**
	 * @param $key string
	 * @param $value mixed
	 */
	public function setOptionDefault( string $key, $value ) {
		$this->defaults[$key] = $value;
	}

	public function getOption( string $key, bool $tree = false ) : ?string {
		$data = $tree ? $this->treeOptions : $this->options;

		return $data[$key] ??
			(isset($this->defaults[$key]) ? $this->defaults[$key] : null);
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

	/**
	 * @param \donatj\MDDoc\Documentation\AbstractDocPart $parent
	 */
	public function setParent( AbstractDocPart $parent ) : void {
		$this->parent = $parent;
	}

	public function getParent() : ?AbstractDocPart {
		return $this->parent;
	}

}
