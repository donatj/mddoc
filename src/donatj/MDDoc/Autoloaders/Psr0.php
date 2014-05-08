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
	public function __construct( $path ) {
		$this->path = rtrim($path, DIRECTORY_SEPARATOR);
	}

	/**
	 * @param string $path
	 * @return string
	 */
	protected final function trimSlashes( $path ) {
		return trim($path, ' /\\');
	}

	/**
	 * @param $class
	 * @return bool|string
	 */
	public function __invoke( $class ) {
		$class       = $this->trimSlashes($class);
		$class_parts = explode('\\', $class);

		$filename = $this->path . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $class_parts) . ".php";

		if( file_exists($filename) ) {
			return $filename;
		}

		return null;
	}

}