<?php

namespace donatj\MDDoc\Runner;

use CLI\Output;
use CLI\Style;

class UserInterface {

	public function __construct( $STDOUT, $STDERR ) {
		Output::$stream = $STDOUT;
	}

	public function dumpOptions( $additional ) {
		$fname = $this->getScript();

		$options = <<<EOT
usage: {$fname} [switches] <docspec>


EOT;

		Output::string($options);
		Output::string($additional);
		Output::string(PHP_EOL);
	}

	public function dropError( $text, $code = 1, $additional = false ) {
		Output::string($this->getScript() . ": " . Style::red($text) . PHP_EOL . ($additional ? $additional . PHP_EOL : ''));
		die($code);
	}

	public function outputMsg( $text ) {
		Output::string($text . PHP_EOL);
	}

	private function getScript() {
		global $argv;
		$pathinfo = pathinfo(realpath($argv[0]));

		return $pathinfo['basename'];
	}

}