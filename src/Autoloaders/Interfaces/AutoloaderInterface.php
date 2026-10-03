<?php

namespace donatj\MDDoc\Autoloaders\Interfaces;

interface AutoloaderInterface {

	/**
	 * Locate the filename of a given class
	 *
	 * @return string|null Filename when the class is found, null otherwise
	 */
	public function __invoke( string $className ) : ?string;

}
