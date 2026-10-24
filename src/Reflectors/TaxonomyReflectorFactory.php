<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

class TaxonomyReflectorFactory {

	/** @var array<string,TaxonomyReflector> */
	private $parsers = [];

	/** @var array<string,true> */
	private $parsing = [];

	/**
	 * @throws \donatj\MDDoc\Exceptions\ClassNotReadableException
	 */
	public function newInstance( string $filename, AutoloaderInterface $autoLoader ) : TaxonomyReflector {
		$filename = realpath($filename) ?: $filename;
		if( !isset($this->parsers[$filename]) ) {
			if( isset($this->parsing[$filename]) ) {
				throw new \LogicException("Circular source dependency: {$filename}");
			}

			$this->parsing[$filename] = true;
			try {
				$this->parsers[$filename] = new TaxonomyReflector($filename, $autoLoader, $this);
			} finally {
				unset($this->parsing[$filename]);
			}
		}

		return $this->parsers[$filename];
	}

	/** @mddoc-ignore */
	public function isParsing( string $filename ) : bool {
		$filename = realpath($filename) ?: $filename;

		return isset($this->parsing[$filename]);
	}

}
