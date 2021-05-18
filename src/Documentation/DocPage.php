<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\TargetNotWritableException;
use donatj\MDDom\Document;

class DocPage extends AbstractNestedDoc {

	public function output( int $depth ) {

		$document = new Document;

		$target         = $this->getOption('target');
		$link           = $this->getOption('link') ?: $target;
		$link_text      = $this->getOption('link-text') ?: "See: {$link}";
		$pre_link_text  = $this->getOption('link-pre-text') ?: '';
		$post_link_text = $this->getOption('link-post-text') ?: '';

		if( (is_file($target) && !is_writable($target)) || !$this->recursiveTouch($target) ) {
			throw new TargetNotWritableException($target . ' not writable');
		}

//		$output = '';
		foreach( $this->getChildren() as $child ) {
			$document->appendChild($child->output(0));
		}

		file_put_contents($target, $document->exportMarkdown());

		return "{$pre_link_text}[{$link_text}]({$link}){$post_link_text}\n\n";
	}

	private function recursiveTouch( $new, $time = null ) : bool {
		if( $time === null ) {
			$time = time();
		}

		if( $new[0] !== '/' && $new[0] !== '.' ) {
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
				if( !mkdir($path) && !is_dir($path) ) {
					return false;
				}
			}
		}

		return touch($new, $time);
	}

	protected function init() : void {
		$this->requireOption('target');
	}

}
