<?php

namespace donatj\MDDoc\Autoloaders;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

/**
 * Class Psr0
 *
 * @link https://github.com/CorpusPHP/Autoloader
 * @package donatj\MDDoc\Autoloaders
 */
class Psr0 implements AutoloaderInterface {

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @param string $path Root path
	 */
	public function __construct( string $path ) {
		$this->path = rtrim($path, DIRECTORY_SEPARATOR);
	}

	final protected function trimSlashes( string $path ) : string {
		return trim($path, ' /\\');
	}

	public function __invoke( string $className ) : ?string {
		$className   = $this->trimSlashes($className);
		$class_parts = explode('\\', $className);

		$filename = $this->path . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $class_parts) . ".php";

		if( file_exists($filename) ) {
			return $filename;
		}

		return null;
	}

}
