<?php

namespace donatj\MDDoc\Autoloaders;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

class NullLoader implements AutoloaderInterface {

	public function __invoke( string $className ) : ?string {
		return null;
	}

}
