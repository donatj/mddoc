<?php

namespace donatj\MDDoc\Autoloaders\Interfaces;

interface AutoloaderInterface {

	/**
	 * @param string $root
	 * @return \Closure
	 */
	public static function makeAutoloader( $root );

} 