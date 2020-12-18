<?php

namespace donatj\MDDoc\Autoloaders\Interfaces;

interface AutoloaderInterface {

	public function __invoke( string $className ) : ?string;

}
