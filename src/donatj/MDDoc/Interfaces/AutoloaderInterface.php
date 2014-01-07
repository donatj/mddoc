<?php

namespace donatj\MDDoc\Interfaces;

interface AutoloaderInterface {

	/**
	 * @param string $root
	 * @return \Closure
	 */
	public static function makeAutoloader( $root );

} 