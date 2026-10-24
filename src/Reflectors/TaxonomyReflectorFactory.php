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
		if( isset($this->parsers[$filename]) ) {
			return $this->parsers[$filename];
		}

		$parser = TaxonomyReflector::fromFile($filename, $autoLoader, $this);
		$this->parsers[$filename] = $parser;
		$parser = $parser->withResolvedDependencies();
		$this->parsers[$filename] = $parser;

		return $parser;
	}

}
