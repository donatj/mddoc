<?php

/**
 * Include a coverage badge from BadgeCoveralls.io
 */

namespace donatj\MDDoc\Documentation\Badges;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class BadgeCoveralls extends Badge implements LoggerAwareInterface {

	use LoggerAwareTrait;

	private const URL_COVERALLS_BASE = 'https://coveralls.io/';

	/**
	 * The BadgeCoveralls name of the Project.
	 *
	 * This includes the service name, e.g. "github/donatj/php-dnf-solver"
	 *
	 * @mddoc-required
	 */
	public const OPT_NAME = 'name';

	/** The branch to show. Defaults to empty which shows the default branch */
	public const OPT_BRANCH = 'branch';

	protected function init() : void {
		$this->setOptionDefault(self::OPT_BRANCH, null);
		$this->setOptionDefault(self::OPT_ALT, 'Coverage Status');

		$name = $this->requireOption(self::OPT_NAME);

		$query = http_build_query(array_filter([
			'branch' => $this->getOption(self::OPT_BRANCH),
		]));

		$this->setOptionDefault(self::OPT_SRC, rtrim(self::URL_COVERALLS_BASE . 'repos/' . $name . '/badge.svg?' . $query, '?'));
		$this->setOptionDefault(self::OPT_HREF, self::URL_COVERALLS_BASE . $name);

		parent::init();
	}

	public function output( int $depth ) : string {
		$name = $this->requireOption(self::OPT_NAME);
		if($this->logger && substr_count($name, '/') < 2) {
			$this->logger->warning("BadgeCoveralls name option '{$name}' does not appear to include the service prefix (e.g. 'github/'). Badge or link may not work correctly.");
		}

		return parent::output($depth);
	}


	public static function tagName() : string {
		return 'badge-coveralls';
	}

}
