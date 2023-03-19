<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDoc\Runner\ImmutableAttributeTree;

abstract class AbstractDocPart implements DocumentationInterface {

	private $defaults = [];

	/** @var AbstractDocPart */
	private $parent;
	/** @var \donatj\MDDoc\Runner\ImmutableAttributeTree */
	protected $attributeTree;
	/** @var string */
	protected $workingDir;

	public function __construct( ImmutableAttributeTree $attributeTree, string $textContent = '' ) {
		$this->attributeTree = $attributeTree;
		$workingDir          = $this->getOption('working-dir', true);
		if( $workingDir !== null ) {
			$this->workingDir = realpath($workingDir);
		} else {
			$this->workingDir = realpath(getcwd());
		}

		$this->init();
	}

	abstract protected function init() : void;

	public function setOptionDefault( string $key, ?string $value ) : void {
		$this->defaults[$key] = $value;
	}

	protected function getOption( string $key, bool $tree = false ) : ?string {
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

	/**
	 * @internal
	 */
	public function setParent( AbstractDocPart $parent ) : void {
		$this->parent = $parent;
	}

	public function getParent() : ?AbstractDocPart {
		return $this->parent;
	}

	/**
	 * @throws \donatj\MDDoc\Exceptions\PathNotReadableException
	 */
	protected function getWorkingFilePath( string $calledPath ) : string {
		if( $calledPath[0] === '/' || $calledPath[1] === ':' ) {
			$path = realpath($calledPath);
		} else {
			$path = realpath($this->workingDir . '/' . $calledPath);
		}

		if( !$path || !is_readable($path) ) {
			throw new PathNotReadableException("Path not readable", $calledPath);
		}

		return $path;
	}

}
