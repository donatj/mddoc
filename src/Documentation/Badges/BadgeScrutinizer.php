<?php

/**
 * Include a badge "shield" image from Scrutinizer CI
 */

namespace donatj\MDDoc\Documentation\Badges;

use donatj\MDDoc\Exceptions\ConfigException;

class BadgeScrutinizer extends Badge {

	// @todo /g/ should be a configurable option - g = github
	private const URL_SCRUTINIZER_BASE = 'https://scrutinizer-ci.com/g/';

	/**
	 * The packagist name of the Scrutinizer Project. Defaults to the name key of the composer.json file in the root of the project. Required if the composer.json file is not present.
	 * @mddoc-required
	 */
	public const OPT_NAME = 'name';
	/**
	 * The type of badge to display. One of: "quality" "coverage" "build-status"
	 * @mddoc-required
	 */
	public const OPT_TYPE = 'type';

	/** The Scrutinizer endpoint to use. Defaults based on the type */
	public const OPT_SUFFIX = 'suffix';
	/** The branch to show. Defaults to "master" */
	public const OPT_BRANCH = 'branch';

	private const BADGES = [
		'quality'      => [
			self::OPT_ALT    => 'Scrutinizer Code Quality',
			self::OPT_SUFFIX => '/badges/quality-score.png',
		],
		'coverage'     => [
			self::OPT_ALT    => 'Code Coverage',
			self::OPT_SUFFIX => '/badges/coverage.png',
		],
		'build-status' => [
			self::OPT_ALT    => 'Build Status',
			self::OPT_SUFFIX => '/badges/build.png',
		],
	];

	protected function init() : void {
		$this->setOptionDefault(self::OPT_BRANCH, 'master');

		$this->requireOption(self::OPT_TYPE);

		$type = $this->getOption(self::OPT_TYPE);
		if( empty(self::BADGES[$type]) ) {
			throw new ConfigException('Invalid Scrutinizer badge type');
		}

		$this->requireOption(self::OPT_NAME);
		$name = $this->getOption(self::OPT_NAME);

		$this->setOptionDefault(self::OPT_SRC, self::URL_SCRUTINIZER_BASE . $name . self::BADGES[$type][self::OPT_SUFFIX] . '?b=' . $this->getOption(self::OPT_BRANCH));
		$this->setOptionDefault(self::OPT_HREF, self::URL_SCRUTINIZER_BASE . $name);
		$this->setOptionDefault(self::OPT_ALT, self::BADGES[$type][self::OPT_ALT]);

		parent::init();
	}

	public static function tagName() : string {
		return 'badge-scrutinizer';
	}

}
