<?php
/**
 * Created by PhpStorm.
 * User: jdonat
 * Date: 1/6/14
 * Time: 5:45 PM
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;

class RecursiveDirectory extends AbstractNestedDoc implements AutoloaderAware {

	private $autoloader;

	public function setAutoloader( \Closure $autoloader ) {
		$this->autoloader = $autoloader;
	}

	public function output( $depth ) {
		$this->requireOptions('name');
		$name = $this->getOption('name');

		foreach( $this->getFileList($name) as $file ) {
			$class = new ClassFile();
			$class->setOptions(array('name' => (string)$file), $this->treeOptions);
			$this->addChild($class);
		}

		$output = '';
		foreach( $this->getChildren() as $child ) {
			/**
			 * @var ClassFile $child
			 */
			if( $this->autoloader instanceof \Closure ) {
				$child->setAutoloader($this->autoloader);
			}
			$output .= $this->cleanup($child->output($depth));
		}

		return $this->cleanup($output);
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