<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\UIAwareDocumentationInterface;
use donatj\MDDoc\Exceptions\TargetNotWritableException;
use donatj\MDDoc\Runner\TextUI;
use donatj\MDDom\Document;

class DocPage extends AbstractNestedDoc implements UIAwareDocumentationInterface {

	/** @var \donatj\MDDoc\Runner\TextUI|null */
	protected $ui;

	public function output( int $depth ) : string {

		$document = new Document;

		$target         = $this->getOption('target');
		$link           = $this->getOption('link') ?: $target;
		$link_text      = $this->getOption('link-text') ?: "See: {$link}";
		$pre_link_text  = $this->getOption('link-pre-text') ?: '';
		$post_link_text = $this->getOption('link-post-text') ?: '';

		$target = realpath($target);

		if( (is_file($target) && !is_writable($target)) || !$this->recursiveTouch($target) ) {
			throw new TargetNotWritableException("Path '{$target}' not writable");
		}

		foreach( $this->getChildren() as $child ) {
			$document->appendChild($child->output(0));
		}

		if( @file_put_contents($target, $document->exportMarkdown()) === false ) {
			throw new TargetNotWritableException("failed to write to '{$target}'");
		}

		if($this->ui) {
			$this->ui->log("output '{$target}'");
		}

		return "{$pre_link_text}[{$link_text}]({$link}){$post_link_text}\n\n";
	}

	private function recursiveTouch( $new, ?int $time = null ) : bool {
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

	public function setUI( TextUI $ui ) {
		$this->ui = $ui;
	}

}
