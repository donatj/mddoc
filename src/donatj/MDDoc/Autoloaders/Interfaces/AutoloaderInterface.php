<?php

namespace donatj\MDDoc\Autoloaders\Interfaces;

interface AutoloaderInterface {

	/**
	 * @param $className
	 * @return string|null
	 */
	public function __invoke($className);

} 