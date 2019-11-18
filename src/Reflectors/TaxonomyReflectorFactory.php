<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

class TaxonomyReflectorFactory {

	private $parsers = [];

	/**
	 * @param  $filename string
	 * @return TaxonomyReflector
	 * @throws \donatj\MDDoc\Exceptions\ClassNotReadableException
	 */
	public function newInstance( $filename, AutoloaderInterface $autoLoader ) {
		if( !isset($this->parsers[$filename]) ) {
			$this->parsers[$filename] = new TaxonomyReflector($filename, $autoLoader, $this);
		}

		return $this->parsers[$filename];
	}

}