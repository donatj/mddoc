<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;
use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDom\Document;

class RecursiveDirectory extends AbstractNestedDoc implements AutoloaderAware {

	private $autoloader;

	public function setAutoloader( AutoloaderInterface $autoloader ) {
		$this->autoloader = $autoloader;
	}


	public function output( $depth ) {
		$document = new Document();
		$name     = $this->getOption('name');

		foreach( $this->getFileList($name) as $file ) {
			if( $fileFilter = $this->getOption('file-filter') ) {
				if( !preg_match($fileFilter, (string)$file) ) {
					continue;
				}
			}

			$class = new ClassFile(array( 'name' => (string)$file ), $this->treeOptions);
			$this->addChild($class);
		}

		foreach( $this->getChildren() as $child ) {
			if( $child instanceof AutoloaderAware ) {
				$child->setAutoloader($this->autoloader);
			}

			$document->appendChild($child->output($depth));
		}

		return $document;
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
			$files = new \RegexIterator($ite, "/\\.php$/");

			return $files;
		} elseif( is_readable($path) ) {
			return new \ArrayIterator(array( $path ));
		}

		throw new PathNotReadableException("Path not readable", $path);
	}
}