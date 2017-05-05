<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\ConfigException;

abstract class AbstractDocPart implements DocumentationInterface {

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
	public function setOptionDefault( $key, $value ) {
		$this->defaults[$key] = $value;
	}

	/**
	 * @param string $key
	 * @param bool   $tree
	 * @return null|string
	 */
	public function getOption( $key, $tree = false ) {
		$data = $tree ? $this->treeOptions : $this->options;
		$val  = isset($data[$key]) ? $data[$key] :
			(isset($this->defaults[$key]) ? $this->defaults[$key] : null);

		return $val;
	}

	/**
	 * @param string|array $options
	 * @param bool         $tree
	 * @throws \donatj\MDDoc\Exceptions\ConfigException
	 */
	protected function requireOptions( $options, $tree = false ) {

		$data = $tree ? $this->treeOptions : $this->options;

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
	public function setParent( AbstractDocPart $parent ) {
		$this->parent = $parent;
	}

	/**
	 * @return AbstractDocPart|null
	 */
	public function getParent() {
		return $this->parent;
	}

}