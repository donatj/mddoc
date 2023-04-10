<?php

/**
 * Include a badge "shield" image from Shielded.dev
 *
 * Either the id or the color, title, and text options must be provided.
 *
 * @see https://shielded.dev/
 */

namespace donatj\MDDoc\Documentation\Badges;

class BadgeShielded extends Badge {

	private const URL_SHIELDED_BASE = 'https://img.shielded.dev/s';

	/** The ID of the badge to display when displaying a dynamic badge. */
	public const OPT_ID = 'id';

	/** The color of the badge when displaying a static badge. */
	public const OPT_COLOR = 'color';
	/** The title of the badge when displaying a static badge. */
	public const OPT_TITLE = 'title';
	/** The text of the badge when displaying a static badge. */
	public const OPT_TEXT  = 'text';

	protected function init() : void {
		$id  = $this->getOption(self::OPT_ID);
		$url = self::URL_SHIELDED_BASE;
		if( $id ) {
			$url = self::URL_SHIELDED_BASE . '/' . urlencode($id);
		}

		$title = $this->getOption(self::OPT_TITLE) ?? '';
		$text  = $this->getOption(self::OPT_TEXT) ?? '';
		$color = $this->getOption(self::OPT_COLOR) ?? '';

		$url .= '?' . http_build_query(array_filter([
			'title' => $title,
			'text'  => $text,
			'color' => $color,
		], static function ( $v ) {
			return $v !== '';
		}));

		$url = rtrim($url, '?');

		if( $title || $text ) {
			$this->setOptionDefault(self::OPT_ALT, trim($title . ' : ' . $text, ' :'));
		} else {
			$this->setOptionDefault(self::OPT_ALT, 'Shielded Badge');
		}

		$this->setOptionDefault(self::OPT_SRC, $url);

		parent::init();
	}

	public static function tagName() : string {
		return 'badge-shielded';
	}

}
