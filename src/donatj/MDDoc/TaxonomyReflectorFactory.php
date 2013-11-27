<?php

namespace donatj\MDDoc;

use phpDocumentor\Reflection\ClassReflector;

class TaxonomyReflectorFactory {

	private $parsers = array();

	/**
	 * @param          $filename
	 * @param callable $autoLoader
	 * @return TaxonomyReflector
	 */
	function newInstance( $filename, callable $autoLoader ) {
		if( !isset($this->parsers[$filename]) ) {
			$this->parsers[$filename] = new TaxonomyReflector( $filename, $autoLoader, $this );
		}

		return $this->parsers[$filename];
	}

}