<?php

namespace donatj\MDDoc\Autoloaders;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

/**
 * Class Psr4
 *
 * @link https://github.com/CorpusPHP/Autoloader
 * @package donatj\MDDoc\Autoloaders
 */
class Psr4 implements AutoloaderInterface {

	/**
	 * @var string
	 */
	protected $namespace;

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @param string $root_namespace Namespace prefix
	 * @param string $path Root path
	 */
	public function __construct( string $root_namespace, string $path ) {
		$this->namespace = $this->trimSlashes($root_namespace);
		$this->path      = rtrim($path, DIRECTORY_SEPARATOR);
	}

	/**
	 * @param string $path
	 * @return string
	 */
	final protected function trimSlashes( $path ) {
		return trim($path, ' /\\');
	}

	/**
	 * @param $class
	 * @return bool|null
	 */
	public function __invoke( $class ) {
		$class    = $this->trimSlashes($class);
		$ns_count = count(explode('\\', $this->namespace));

		if( $this->isOfNamespace($class) ) {
			$class_parts = explode('\\', $class);
			$class_parts = array_slice($class_parts, $ns_count);

			$filename = $this->path . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $class_parts) . ".php";

			if( file_exists($filename) ) {
				return $filename;
			}

		}

		return null;
	}

	/**
	 * @param $class_name
	 * @return bool
	 */
	protected function isOfNamespace( $class_name ) {
		return stripos($class_name, $this->namespace . '\\') === 0;
	}

}
