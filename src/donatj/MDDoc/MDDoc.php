<?php

namespace donatj\MDDoc;

use donatj\Flags;
use donatj\MDDoc\Runner\ConfigParser;

/**
 * Application MDDoc
 *
 * @package donatj\MDDoc
 */
class MDDoc {

	function __construct( $args ) {

		$this->init($args);

		$x = new ConfigParser('mddoc.xml');

	}

	private function init( $args ) {
		$flags       = new Flags();
		$displayHelp = & $flags->bool('help', false, 'Display this help message.');

		try {
			$flags->parse($args);
		} catch(\Exception $e) {
//			$ui->dropError($e->getMessage(), 1, $flags->getDefaults());
			drop($e->getMessage(), 1, $flags->getDefaults());
		}
	}
}