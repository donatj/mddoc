<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Reflectors\Source\ClassDefinition;

class TaxonomyReflectorFactory {

	/** @var array<string,TaxonomyReflector> */
	private $parsers = [];

	/** @var array<string,true> */
	private $resolvingFiles = [];

	/** @var array<string,true> */
	private $resolvingClasses = [];

	/**
	 * @throws \donatj\MDDoc\Exceptions\ClassNotReadableException
	 */
	public function newInstance( string $filename, AutoloaderInterface $autoLoader ) : TaxonomyReflector {
		if( isset($this->parsers[$filename]) ) {
			return $this->parsers[$filename];
		}

		$this->parsers[$filename] = new TaxonomyReflector($filename, $autoLoader, $this);
		$this->resolvingFiles[$filename] = true;

		try {
			$this->parsers[$filename] = $this->parsers[$filename]->withResolvedDependencies();
		} catch( \Throwable $ex ) {
			unset($this->parsers[$filename]);

			throw $ex;
		} finally {
			unset($this->resolvingFiles[$filename]);
		}

		return $this->parsers[$filename];
	}

	/** @mddoc-ignore */
	public function resolveClass( string $filename, string $name, AutoloaderInterface $autoLoader ) : ?ClassDefinition {
		$parser = $this->newInstance($filename, $autoLoader);
		if( !isset($this->resolvingFiles[$filename]) ) {
			return $parser->getClass($name);
		}

		$key = $filename . "\0" . strtolower(ltrim($name, '\\'));
		if( isset($this->resolvingClasses[$key]) ) {
			return $parser->getClass($name);
		}

		$this->resolvingClasses[$key] = true;
		try {
			return $parser->withResolvedClass($name)->getClass($name);
		} finally {
			unset($this->resolvingClasses[$key]);
		}
	}

}
