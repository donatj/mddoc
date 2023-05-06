<?php

/**
 * Include a coverage badge from BadgeCoveralls.io
 */

namespace donatj\MDDoc\Documentation\Badges;

class BadgeCoveralls extends Badge {

	private const URL_COVERALLS_BASE = 'https://coveralls.io/';

	/**
	 * The BadgeCoveralls name of the Project. Required.
	 *
	 * This includes the service name, e.g. "github/donatj/php-dnf-solver"
	 */
	public const OPT_NAME = 'name';

	/** The branch to show. Defaults to empty which shows the default branch */
	public const OPT_BRANCH = 'branch';

	protected function init() : void {
		$this->setOptionDefault(self::OPT_BRANCH, null);
		$this->setOptionDefault(self::OPT_ALT, 'Build Status');

		$this->requireOption(self::OPT_NAME);
		$name = $this->getOption(self::OPT_NAME);

		$query = http_build_query(array_filter([
			'branch' => $this->getOption(self::OPT_BRANCH),
		]));

		$this->setOptionDefault(self::OPT_SRC, rtrim(self::URL_COVERALLS_BASE . 'repos/' . $name . '/badge.svg?' . $query, '?'));
		$this->setOptionDefault(self::OPT_HREF, self::URL_COVERALLS_BASE . $name);

		parent::init();
	}

	public static function tagName() : string {
		return 'badge-coveralls';
	}

}
