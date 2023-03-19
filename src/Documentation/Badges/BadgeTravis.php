<?php

/**
 * Include a badge "shield" image from Travis CI
 */

namespace donatj\MDDoc\Documentation\Badges;

class BadgeTravis extends Badge {

	/**
	 * The packagist name of the Travis Project. Defaults to the name key of the composer.json file in the root of the project. Required if the composer.json file is not present.
	 * @mddoc-required
	 */
	public const OPT_NAME = 'name';
	private const URL_TRAVIS_BASE = 'https://travis-ci.org/';

	/** The branch to show. Defaults to "master" */
	public const OPT_BRANCH = 'branch';

	protected function init() : void {
		$this->setOptionDefault(self::OPT_BRANCH, 'master');
		$this->setOptionDefault(self::OPT_ALT, 'Build Status');

		$this->requireOption(self::OPT_NAME);
		$name = $this->getOption(self::OPT_NAME);

		$this->setOptionDefault(self::OPT_SRC, self::URL_TRAVIS_BASE . $name . '.svg?branch=' . $this->getOption(self::OPT_BRANCH));
		$this->setOptionDefault(self::OPT_HREF, self::URL_TRAVIS_BASE . $name);

		parent::init();
	}

	public static function tagName() : string {
		return 'badge-travis';
	}

}
