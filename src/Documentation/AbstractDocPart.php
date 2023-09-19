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
			$this->workingDir = realpath($workingDir);
		} else {
			$this->workingDir = realpath(getcwd());
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
