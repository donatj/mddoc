<?php

namespace donatj\MDDoc\Interfaces;

interface AutoloaderAware {

	public function setAutoloader( \Closure $autoloader );

}
