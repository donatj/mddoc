<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\TargetNotWritableException;

class DocPage extends AbstractNestedDoc {

	private $target;

	function __construct( $target ) {

		if( (is_file($target) && !is_writable($target)) || !$this->recursiveTouch($target) ) {
			throw new TargetNotWritableException($target . ' not writable');
		}

		$this->target = $target;
	}

	private function recursiveTouch( $new, $time = false ) {
		if( !$time ) {
			$time = time();
		}

		if( $new[0] != '/' && $new[0] != '.' ) {
			$new = realpath('.') . '/' . $new;
		}

		$dirs = explode('/', $new);
		array_pop($dirs);

		$path = '';
		array_filter($dirs);
		foreach( $dirs as $dir ) {
			$path .= '/' . $dir;
			if( !is_dir($path) ) {
				see($path);
				if( !mkdir($path) ) return false;
			}
		}

		return touch($new, $time);
	}

	public function output( $depth ) {
		$output = '';
		foreach( $this->getChildren() as $child ) {
			$output .= $child->output(0);
		}

		file_put_contents($this->target, $output);

		return "[See: {$this->target}]({$this->target})\n\n";
	}
}