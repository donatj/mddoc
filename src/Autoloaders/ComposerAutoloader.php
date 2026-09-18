<?php

namespace donatj\MDDoc\Autoloaders;

use Composer\Autoload\ClassLoader;
use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;

class ComposerAutoloader implements AutoloaderInterface {

	private ClassLoader $loader;

	public function __construct( ClassLoader $loader ) {
		$this->loader = $loader;
	}

	public function __invoke( string $className ) : ?string {
		$filename = $this->loader->findFile(ltrim($className, '\\'));

		return $filename === false ? null : $filename;
	}

}
