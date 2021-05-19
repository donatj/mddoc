<?php

namespace donatj\MDDoc\Autoloaders\Interfaces;

interface AutoloaderInterface {

	/**
	 * Locate the filename of a given class
	 *
	 * @return string|null filename on class found, null on not found
	 */
	public function __invoke( string $className ) : ?string;

}
