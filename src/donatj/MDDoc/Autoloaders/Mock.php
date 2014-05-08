<?php

namespace donatj\MDDoc\Autoloaders;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

class Mock implements AutoloaderInterface {

	/**
	 * @param $className
	 * @return string|null
	 */
	public function __invoke( $className ) {
		return null;
	}

}
 