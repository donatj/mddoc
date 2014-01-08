<?php

namespace donatj\MDDoc\Autoloaders;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

class Psr0 implements AutoloaderInterface {

	public static function makeAutoloader( $root ) {
		$root = rtrim($root, '/') . '/';
		return function ( $className ) use ($root) {
			$className = ltrim($className, '\\');
			$fileName  = '';
			$namespace = '';
			if( $lastNsPos = strrpos($className, '\\') ) {
				$namespace = substr($className, 0, $lastNsPos);
				$className = substr($className, $lastNsPos + 1);
				$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
			}
			$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

			$fileName = $root . $fileName;
			if( file_exists($fileName) ) {
				return $fileName;
			}

			return null;
		};
	}

}