<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

class TaxonomyReflectorFactory {

	/** @var array<string,TaxonomyReflector> */
	private $parsers = [];

	/**
	 * @throws \donatj\MDDoc\Exceptions\ClassNotReadableException
	 */
	public function newInstance( string $filename, AutoloaderInterface $autoLoader ) : TaxonomyReflector {
		if( !isset($this->parsers[$filename]) ) {
			$this->parsers[$filename] = new TaxonomyReflector($filename, $autoLoader, $this);
		}

		return $this->parsers[$filename];
	}

}
