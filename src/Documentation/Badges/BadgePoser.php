<?php

namespace donatj\MDDoc\Documentation\Badges;

use donatj\MDDoc\Exceptions\ConfigException;

class BadgePoser extends Badge {

	const URL_POSER_BASE     = 'https://poser.pugx.org/';
	const URL_PACKAGIST_BASE = 'https://packagist.org/packages/';

	const OPT_SUFFIX = 'suffix';

	protected $badges = [
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
		'composerlock' => [
			self::OPT_ALT    => 'composer.lock available',
			self::OPT_SUFFIX => '/composerlock',
		],
	];

	protected function init() {
		$this->requireOptions('type');

		$type = $this->getOption('type');
		if( empty($this->badges[$type]) ) {
			throw new ConfigException('Invalid Poser badge type');
		}

		$file = 'composer.json';
		$name = $this->getOption('name');
		if( !$name && is_readable($file) ) {
			$data   = file_get_contents($file);
			$parsed = @json_decode($data, true);
			if( !empty($parsed['name']) && is_string($parsed['name']) ) {
				$name = $parsed['name'];
			}
		}

		if( $name ) {
			$this->setOptionDefault('name', $name);
		}

		$this->requireOptions('name');

		$this->setOptionDefault(self::OPT_SRC, self::URL_POSER_BASE . $name . $this->badges[$type][self::OPT_SUFFIX]);
		$this->setOptionDefault(self::OPT_HREF, self::URL_PACKAGIST_BASE . $name);
		$this->setOptionDefault(self::OPT_ALT, $this->badges[$type][self::OPT_ALT]);

		parent::init();
	}

}
