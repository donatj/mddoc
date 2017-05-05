<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDom\Anchor;
use donatj\MDDom\Image;

class Badge extends AbstractDocPart {

	public function output( $depth ) {
		$img = new Image($this->getOption('src'), $this->getOption('alt'));

		if( $href = $this->getOption('href') ) {
			$out = new Anchor($href,
				$img->exportMarkdown(),
				$this->getOption('title') ?: '');
		} else {
			$out = $img;
		}

		return $out->exportMarkdown() . "\n";
	}

	protected function init() {
		$this->requireOptions('src');
		$this->requireOptions('alt');
	}

}
