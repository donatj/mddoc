<?php

namespace donatj\MDDoc\Autoloaders;

use Countable;
use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

/**
 * A simple autoloader chain
 */
class MultiLoader implements AutoloaderInterface, Countable {

	/** @var AutoloaderInterface[] */
	private $loaders;

	public function __construct( AutoloaderInterface ...$loaders ) {
		$this->loaders = $loaders;
	}

	public function __invoke( string $className ) : ?string {
		foreach( $this->loaders as $loader ) {
			$filename = $loader($className);
			if( $filename !== null ) {
				return $filename;
			}
		}

		return null;
	}

	public function appendLoader( AutoloaderInterface $loader ) : void {
		$this->loaders[] = $loader;
	}

	public function count() : int {
		return count($this->loaders);
	}

}
