<?php

namespace donatj\MDDoc\Documentation\Interfaces;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

interface AutoloaderAware {

	public function setAutoloader( AutoloaderInterface $autoloader );

}
