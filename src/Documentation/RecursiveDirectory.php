<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;
use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDom\Document;

class RecursiveDirectory extends AbstractNestedDoc implements AutoloaderAware {

	private $autoloader;

	public function setAutoloader( AutoloaderInterface $autoloader ) : void {
		$this->autoloader = $autoloader;
	}

	public function output( int $depth ) {
		$document = new Document;
		$name     = $this->getOption('name');

		foreach( $this->getFileList($name) as $file ) {
			if( $fileFilter = $this->getOption('file-filter') ) {
				if( !preg_match($fileFilter, (string)$file) ) {
					continue;
				}
			}

			$class = new ClassFile(
				$this->attributeTree->withAttr([ 'name' => (string)$file ])
			);
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

	protected function init() : void {
		$this->requireOption('name');
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

			$fileArray = iterator_to_array($files, false);
			usort($fileArray, function ( \SplFileInfo $a, \SplFileInfo $b ) {
				return strnatcasecmp($a->getRealPath(), $b->getRealPath());
			});

			return new \ArrayIterator($fileArray);
		}

		if( is_readable($path) ) {
			return new \ArrayIterator([ $path ]);
		}

		throw new PathNotReadableException("Path not readable", $path);
	}

}
