<?php

namespace donatj\MDDoc\Autoloaders;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

/**
 * Class Psr4
 *
 * @see https://github.com/CorpusPHP/Autoloader
 */
class Psr4 implements AutoloaderInterface {

	/** @var string */
	protected $namespace;

	/** @var string */
	protected $path;

	/**
	 * @param string $root_namespace Namespace prefix
	 * @param string $path           Root path
	 */
	public function __construct( string $root_namespace, string $path ) {
		$this->namespace = $this->trimSlashes($root_namespace);
		$this->path      = rtrim($path, DIRECTORY_SEPARATOR);
	}

	final protected function trimSlashes( string $path ) : string {
		return trim($path, ' /\\');
	}

	public function __invoke( string $className ) : ?string {
		$className = $this->trimSlashes($className);
		$ns_count  = count(explode('\\', $this->namespace));

		if( $this->isOfNamespace($className) ) {
			$class_parts = explode('\\', $className);
			$class_parts = array_slice($class_parts, $ns_count);

			$filename = $this->path . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $class_parts) . ".php";

			if( file_exists($filename) ) {
				return $filename;
			}
		}

		return null;
	}

	protected function isOfNamespace( string $className ) : bool {
		return stripos($className, $this->namespace . '\\') === 0;
	}

}
