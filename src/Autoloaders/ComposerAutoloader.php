<?php

namespace donatj\MDDoc\Autoloaders;

use Composer\Autoload\ClassLoader;
use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

class ComposerAutoloader implements AutoloaderInterface {

	private ?ClassLoader $loader = null;

	public function __construct( string $projectRoot ) {
		$vendorDirectory = realpath(rtrim($projectRoot, ' /\\') . DIRECTORY_SEPARATOR . 'vendor');
		if( $vendorDirectory === false || !is_file($vendorDirectory . DIRECTORY_SEPARATOR . 'autoload.php') ) {
			return;
		}

		foreach( ClassLoader::getRegisteredLoaders() as $directory => $loader ) {
			if( realpath($directory) === $vendorDirectory ) {
				$this->loader = $loader;
				return;
			}
		}
	}

	public function __invoke( string $className ) : ?string {
		if( $this->loader === null ) {
			return null;
		}

		$filename = $this->loader->findFile(ltrim($className, '\\'));

		return $filename === false ? null : $filename;
	}

}
