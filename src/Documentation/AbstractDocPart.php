<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDoc\Runner\ImmutableAttributeTree;

abstract class AbstractDocPart extends AbstractElement implements DocumentationInterface {

	/** @var string */
	protected $workingDir;

	public function __construct( ImmutableAttributeTree $attributeTree, string $textContent = '' ) {
		parent::__construct($attributeTree, $textContent);

		$workingDir = $this->getOption('working-dir', true);
		if( $workingDir !== null ) {
			$path = realpath($workingDir);
			if( $path === false || !is_dir($path) ) {
				throw new PathNotReadableException("Provided Working Directory not readable", $workingDir);
			}

			$this->workingDir = $path;
		} else {
			$cwd = getcwd();
			if( $cwd === false ) {
				throw new PathNotReadableException("Failed to fetch Current Working Directory", '.');
			}

			$path = realpath($cwd);
			if( $path === false || !is_dir($path) ) {
				throw new PathNotReadableException("Current Working Directory not readable", $cwd);
			}

			$this->workingDir = $path;
		}

		$this->init();
	}

	abstract protected function init() : void;

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
