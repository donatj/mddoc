<?php

/**
 * Include a badge "shield" image for a GitHub Actions workflow
 */

namespace donatj\MDDoc\Documentation\Badges;

class BadgeGitHubActions extends Badge {

	private const URL_GITHUB_BASE = 'https://github.com';

	/**
	 * The name of the `.yml` file in the `.github/workflows/` directory including the `.yml` extension
	 * @mddoc-required
	 */
	public const OPT_NAME   = 'name';
	/** The name of the branch to show the badge for. Defaults to the default branch. */
	public const OPT_BRANCH = 'branch';
	public const OPT_EVENT  = 'event'; // @todo - this seems to be broken?

	protected function init() : void {
		$this->requireOption(self::OPT_NAME);
		$name = $this->getOption(self::OPT_NAME);

		$this->requireOption('workflow-file');
		$workflow = $this->getOption('workflow-file');

		$this->setOptionDefault(self::OPT_BRANCH, '');
		$this->setOptionDefault(self::OPT_EVENT, '');
		$this->setOptionDefault(self::OPT_ALT, $workflow);

		$src = sprintf('%s/%s/actions/workflows/%s/badge.svg?', self::URL_GITHUB_BASE, $name, urlencode($workflow));
		if( $branch = $this->getOption(self::OPT_BRANCH) ) {
			$src = 'branch=' . urlencode($branch) . '&';
		}

		if( $event = $this->getOption('event') ) {
			$src = 'event=' . urlencode($event) . '&';
		}

		$src = rtrim($src, '&?');

		$href = sprintf('%s/%s/actions/workflows/%s', self::URL_GITHUB_BASE, $name, urlencode($workflow));

		$this->setOptionDefault(self::OPT_SRC, $src);
		$this->setOptionDefault(self::OPT_HREF, $href);

		parent::init();
	}

	public static function tagName() : string {
		return 'badge-github-action';
	}

}
