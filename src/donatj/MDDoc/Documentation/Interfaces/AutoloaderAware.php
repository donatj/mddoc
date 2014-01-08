<?php

namespace donatj\MDDoc\Documentation\Interfaces;

interface AutoloaderAware {

	public function setAutoloader( \Closure $autoloader );

}
