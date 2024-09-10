<?php

/**
 * Include a badge "shield" image from Pugx Poser https://poser.pugx.org/
 */

namespace donatj\MDDoc\Documentation\Badges;

use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Exceptions\PathNotReadableException;

class BadgePoser extends Badge {

	private const URL_POSER_BASE     = 'https://poser.pugx.org/';
	private const URL_PACKAGIST_BASE = 'https://packagist.org/packages/';

	/**
	 * The type of badge to display. One of: "version" "downloads" "unstable" "license" "monthly" "daily" "phpversion"
	 * "composerlock"
	 *
	 * @mddoc-required
	 */
	public const OPT_TYPE = 'type';
	/** The packagist name of the package. Defaults to the name key of the composer.json file in the root of the project. Required if the composer.json file is not present. */
	public const OPT_NAME = 'name';
	/** The poser endpoint to use. Defaults based on the type */
	public const OPT_SUFFIX = 'suffix';

	private const BADGES = [
		'version'      => [
			self::OPT_ALT    => 'Latest Stable Version',
			self::OPT_SUFFIX => '/version',
		],
		'downloads'    => [
			self::OPT_ALT    => 'Total Downloads',
			self::OPT_SUFFIX => '/downloads',
		],
		'unstable'     => [
			self::OPT_ALT    => 'Latest Unstable Version',
			self::OPT_SUFFIX => '/v/unstable',
		],
		'license'      => [
			self::OPT_ALT    => 'License',
			self::OPT_SUFFIX => '/license',
		],
		'monthly'      => [
			self::OPT_ALT    => 'Monthly Downloads',
			self::OPT_SUFFIX => '/d/monthly',
		],
		'daily'        => [
			self::OPT_ALT    => 'Daily Downloads',
			self::OPT_SUFFIX => '/d/daily',
		],
		'phpversion'   => [
			self::OPT_ALT    => 'PHP Version Require',
			self::OPT_SUFFIX => '/require/php',
		],
		'composerlock' => [
			self::OPT_ALT    => 'composer.lock available',
			self::OPT_SUFFIX => '/composerlock',
		],
	];

	protected function init() : void {
		$this->requireOption(self::OPT_TYPE);

		$type = $this->getOption(self::OPT_TYPE);
		if( empty(self::BADGES[$type]) ) {
			throw new ConfigException('Invalid Poser badge type');
		}

		$file = 'composer.json';
		$name = $this->getOption(self::OPT_NAME);
		if( !$name && is_readable($file) ) {
			$data = @file_get_contents($file);
			if( $data === false ) {
				throw new PathNotReadableException('Unable to read composer.json', $file);
			}

			$parsed = @json_decode($data, true);
			if( is_array($parsed) && !empty($parsed['name']) && is_string($parsed['name']) ) {
				$name = $parsed['name'];
			}
		}

		if( $name ) {
			$this->setOptionDefault(self::OPT_NAME, $name);
		}

		$this->requireOption(self::OPT_NAME);

		$this->setOptionDefault(self::OPT_SRC, self::URL_POSER_BASE . $name . self::BADGES[$type][self::OPT_SUFFIX]);
		$this->setOptionDefault(self::OPT_HREF, self::URL_PACKAGIST_BASE . $name);
		$this->setOptionDefault(self::OPT_ALT, self::BADGES[$type][self::OPT_ALT]);

		parent::init();
	}

	public static function tagName() : string {
		return 'badge-poser';
	}

}
