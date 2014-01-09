<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\TargetNotWritableException;

class DocPage extends AbstractNestedDoc {

	private $target;
	private $link;
	private $link_text;
	private $pre_link_text;
	private $post_link_text;

	function __construct( $target, $link = null, $link_text = null, $pre_link_text = null, $post_link_text = null ) {

		if( (is_file($target) && !is_writable($target)) || !$this->recursiveTouch($target) ) {
			throw new TargetNotWritableException($target . ' not writable');
		}

		$this->target    = $target;
		$this->link      = $link ? : $this->target;
		$this->link_text = $link_text ? : "See: {$this->link}";
		$this->pre_link_text = $pre_link_text ?: '';
		$this->post_link_text = $post_link_text ?: '';
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

		return "$this->pre_link_text[{$this->link_text}]({$this->link})$this->post_link_text\n\n";
	}
}