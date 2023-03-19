<?php

namespace donatj\MDDoc\Documentation\Badges;

class BadgeGitHubActions extends Badge {

	private const URL_GITHUB_BASE = 'https://github.com';

	public const OPT_BRANCH = 'branch';
	public const OPT_EVENT  = 'event';

	protected function init() : void {
		$this->requireOption('name');
		$name = $this->getOption('name');

		$this->requireOption('workflow-file');
		$workflow = $this->getOption('workflow-file');

		$this->setOptionDefault(self::OPT_BRANCH, '');
		$this->setOptionDefault(self::OPT_EVENT, '');
		$this->setOptionDefault(self::OPT_ALT, $workflow);

		$src = sprintf('%s/%s/actions/workflows/%s/badge.svg?', self::URL_GITHUB_BASE, $name, urlencode($workflow));
		if( $branch = $this->getOption('branch') ) {
			$src = 'branch=' . urlencode($branch) . '&';
		}

		if( $event = $this->getOption('event') ) {
			$src = 'branch=' . urlencode($event) . '&';
		}

		$href = sprintf('%s/%s/actions/workflows/%s', self::URL_GITHUB_BASE, $name, urlencode($workflow));

		$this->setOptionDefault(self::OPT_SRC, $src);
		$this->setOptionDefault(self::OPT_HREF, $href);

		parent::init();
	}

	public static function tagName() : string {
		return 'badge-github-actions';
	}

}
