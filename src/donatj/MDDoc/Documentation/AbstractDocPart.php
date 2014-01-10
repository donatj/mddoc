<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\ConfigException;

abstract class AbstractDocPart implements DocumentationInterface {

	protected $options;
	protected $treeOptions;

	public function setOptions( array $options, array $tree_options ) {
		$this->options     = $options;
		$this->treeOptions = $tree_options;
	}

	/**
	 * @param string $key
	 * @param bool   $tree
	 * @return null|string
	 */
	public function getOption( $key, $tree = false ) {
		$data = $tree ? $this->treeOptions : $this->options;

		return isset($data[$key]) ? $data[$key] : null;

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
			if( !isset($data[$key]) ) {
				throw new ConfigException(get_called_class() . " requires {$key} attribute.");
			}
		}
	}


}
