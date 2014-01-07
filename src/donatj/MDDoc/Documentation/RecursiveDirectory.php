<?php
/**
 * Created by PhpStorm.
 * User: jdonat
 * Date: 1/6/14
 * Time: 5:45 PM
 */

namespace donatj\MDDoc\Documentation;


class RecursiveDirectory extends AbstractNestedDoc {

	function __construct( $name ) {
		foreach( $this->getFileList($name) as $file ) {
			$this->addChild(new File((string)$file));
		}
	}

	public function output( $depth ) {
		$output = '';
		foreach($this->getChildren() as $child) {
			$output .= $child->output($depth);
		}

		return $output;
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