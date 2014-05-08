<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use phpDocumentor\Reflection\ClassReflector;

class TaxonomyReflectorFactory {

	private $parsers = array();

	/**
	 * @param          $filename
	 * @param AutoloaderInterface $autoLoader
	 * @return TaxonomyReflector
	 */
	function newInstance( $filename, AutoloaderInterface $autoLoader ) {
		if( !isset($this->parsers[$filename]) ) {
			$this->parsers[$filename] = new TaxonomyReflector( $filename, $autoLoader, $this );
		}

		return $this->parsers[$filename];
	}

}