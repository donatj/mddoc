<?php

namespace donatj\MDDoc\Documentation\Badges;

class BadgeTravis extends Badge {

	const URL_TRAVIS_BASE = 'https://travis-ci.org/';

	const OPT_BRANCH = 'branch';

	protected function init() : void {
		$this->setOptionDefault(self::OPT_BRANCH, 'master');
		$this->setOptionDefault(self::OPT_ALT, 'Build Status');

		$this->requireOptions('name');
		$name = $this->getOption('name');

		$this->setOptionDefault(self::OPT_SRC, self::URL_TRAVIS_BASE . $name . '.svg?branch=' . $this->getOption('branch'));
		$this->setOptionDefault(self::OPT_HREF, self::URL_TRAVIS_BASE . $name);

		parent::init();
	}

}
