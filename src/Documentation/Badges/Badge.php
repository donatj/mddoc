<?php

namespace donatj\MDDoc\Documentation\Badges;

use donatj\MDDoc\Documentation\AbstractDocPart;
use donatj\MDDom\Anchor;
use donatj\MDDom\Image;

class Badge extends AbstractDocPart {

	const OPT_ALT   = 'alt';
	const OPT_SRC   = 'src';
	const OPT_HREF  = 'href';
	const OPT_TITLE = 'title';

	public function output( int $depth ) {
		$img = new Image($this->getOption(self::OPT_SRC), $this->getOption(self::OPT_ALT));

		if( $href = $this->getOption(self::OPT_HREF) ) {
			$out = new Anchor($href,
				$img->exportMarkdown(),
				$this->getOption(self::OPT_TITLE) ?: '');
		} else {
			$out = $img;
		}

		return $out->exportMarkdown() . "\n";
	}

	protected function init() {
		$this->requireOptions(self::OPT_SRC);
		$this->requireOptions(self::OPT_ALT);
	}

}
