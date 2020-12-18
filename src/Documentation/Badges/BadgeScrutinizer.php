<?php

namespace donatj\MDDoc\Documentation\Badges;

use donatj\MDDoc\Exceptions\ConfigException;

class BadgeScrutinizer extends Badge {

	// @todo /g/ should be a configurable option - g = github
	private const URL_SCRUTINIZER_BASE = 'https://scrutinizer-ci.com/g/';

	public const OPT_SUFFIX = 'suffix';
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

		$this->requireOptions('type');

		$type = $this->getOption('type');
		if( empty(self::BADGES[$type]) ) {
			throw new ConfigException('Invalid Scrutinizer badge type');
		}

		$this->requireOptions('name');
		$name = $this->getOption('name');

		$this->setOptionDefault(self::OPT_SRC, self::URL_SCRUTINIZER_BASE . $name . self::BADGES[$type][self::OPT_SUFFIX] . '?b=' . $this->getOption(self::OPT_BRANCH));
		$this->setOptionDefault(self::OPT_HREF, self::URL_SCRUTINIZER_BASE . $name);
		$this->setOptionDefault(self::OPT_ALT, self::BADGES[$type][self::OPT_ALT]);

		parent::init();
	}

}
