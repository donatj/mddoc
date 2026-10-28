<?php

namespace donatj\MDDoc\Runner;

use donatj\MDDoc\Exceptions\ConfigException;

class ConfigFinder {

	private const CONFIG_FILES = [
		"mddoc.xml",
		".mddoc.xml",
		"mddoc.dist.xml",
		".mddoc.dist.xml",
		"mddoc.xml.dist",
		".mddoc.xml.dist",
	];

	/**
	 * Find the first existing config file in preference order.
	 *
	 * @param callable(string):bool $fileExists
	 * @throws ConfigException
	 */
	public function find( callable $fileExists ) : string {
		foreach( self::CONFIG_FILES as $configFile ) {
			if( $fileExists($configFile) ) {
				return $configFile;
			}
		}

		throw new ConfigException('No config file found');
	}

}
