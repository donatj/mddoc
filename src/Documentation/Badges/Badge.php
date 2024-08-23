<?php

/**
 * Include a badge "shield" image from a given url
 */

namespace donatj\MDDoc\Documentation\Badges;

use donatj\MDDoc\Documentation\AbstractDocPart;
use donatj\MDDom\Anchor;
use donatj\MDDom\Image;

class Badge extends AbstractDocPart {

	/** The image url **(required)** */
	public const OPT_SRC = 'src';
	/** The image alt text **(required)** */
	public const OPT_ALT = 'alt';
	/** The optional url to link to wrap the badge in */
	public const OPT_HREF = 'href';
	/** The optional link title */
	public const OPT_TITLE = 'title';

	public function output( int $depth ) : string {
		$img = new Image(
			$this->requireOption(self::OPT_SRC),
			$this->requireOption(self::OPT_ALT)
		);

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
