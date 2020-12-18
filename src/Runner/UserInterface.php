<?php

namespace donatj\MDDoc\Runner;

use CLI\Output;
use CLI\Style;

class UserInterface {

	/**
	 * UserInterface constructor.
	 *
	 * @param resource $STDOUT
	 * @param resource $STDERR
	 */
	public function __construct( $STDOUT, $STDERR ) {
		Output::$stream = $STDOUT;
	}

	public function dumpOptions( string $additional ) : void {
		$fname = $this->getScript();

		$options = <<<EOT
usage: {$fname} [switches] <docspec>


EOT;

		Output::string($options);
		Output::string($additional);
		Output::string(PHP_EOL);
	}

	public function dropError( string $text, int $code = 1, ?string $additional = null ) : void {
		Output::string($this->getScript() . ": " . Style::red($text) . PHP_EOL . ($additional ? $additional . PHP_EOL : ''));

		die($code);
	}

	public function outputMsg( string $text ) : void {
		Output::string($text . PHP_EOL);
	}

	private function getScript() : string {
		global $argv;
		$pathinfo = pathinfo(realpath($argv[0]));

		return $pathinfo['basename'];
	}

}
