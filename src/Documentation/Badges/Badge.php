<?php

namespace donatj\MDDoc\Documentation\Badges;

use donatj\MDDoc\Documentation\AbstractDocPart;
use donatj\MDDom\Anchor;
use donatj\MDDom\Image;

class Badge extends AbstractDocPart {

	public const OPT_ALT   = 'alt';
	public const OPT_SRC   = 'src';
	public const OPT_HREF  = 'href';
	public const OPT_TITLE = 'title';

	public function output( int $depth ) : string {
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

	protected function init() : void {
		$this->requireOption(self::OPT_SRC);
		$this->requireOption(self::OPT_ALT);
	}

	public static function tagName() : string {
		return 'badge';
	}

}
