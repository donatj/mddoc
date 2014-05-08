<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;

class RecursiveDirectory extends AbstractNestedDoc implements AutoloaderAware {

	private $autoloader;

	public function setAutoloader( AutoloaderInterface $autoloader ) {
		$this->autoloader = $autoloader;
	}


	public function output( $depth ) {
		$name = $this->getOption('name');

		foreach( $this->getFileList($name) as $file ) {
			$class = new ClassFile(array( 'name' => (string)$file ), $this->treeOptions);
			$this->addChild($class);
		}

		$output = '';
		foreach( $this->getChildren() as $child ) {
			$child->setAutoloader($this->autoloader);

			$output .= $this->cleanup($child->output($depth));
		}

		return $this->cleanup($output);
	}

	protected function init() {
		$this->requireOptions('name');
	}

	private function getFileList( $path ) {
		if( $real = realpath($path) ) {
			$path = $real;
		}

		$path = rtrim($path, DIRECTORY_SEPARATOR);

		if( is_dir($path) ) {
			$dir   = new \RecursiveDirectoryIterator($path);
			$ite   = new \RecursiveIteratorIterator($dir);
			$files = new \RegexIterator($ite, "/\.php$/");

			return $files;
		} elseif( is_readable($path) ) {
			return new \ArrayIterator(array( $path ));
		}

	}

}