<?php

namespace donatj\MDDoc\Runner;

use CLI\Style;

class TextUI {

	/** @var resource */
	private $STDERR;
	/** @var resource */
	private $STDOUT;

	/**
	 * UserInterface constructor.
	 *
	 * @param resource $STDOUT
	 * @param resource $STDERR
	 */
	public function __construct( $STDOUT, $STDERR ) {
		$this->STDOUT = $STDOUT;
		$this->STDERR = $STDERR;
	}

	public function dumpOptions( string $additional ) : void {
		$fname = $this->getScript();

		$options = <<<EOT
usage: {$fname} [switches] <docspec>


EOT;

		fwrite($this->STDOUT, $options);
		fwrite($this->STDOUT, $additional);
		fwrite($this->STDOUT, PHP_EOL);
	}

	/**
	 * Output an Error before exiting with given error code
	 *
	 * @param string      $text Primary error log details
	 * @param int         $code Status code to exit with (0-255)
	 * @param string|null $additional Optional - will print on a second line following the log
	 */
	public function dropError( string $text, int $code = 1, ?string $additional = null ) : void {
		fwrite($this->STDERR, $this->getScript() . ": " . Style::red($text) . PHP_EOL . ($additional ? $additional . PHP_EOL : ''));

		die($code);
	}

	public function println( string $text = '' ) : void {
		fwrite($this->STDOUT, $text . PHP_EOL);
	}

	public function log( string $text, bool $timestamp = true ) : void {
		if( $timestamp ) {
			fwrite($this->STDERR, date('c '));
		}

		fwrite($this->STDERR, $text);
		fwrite($this->STDERR, PHP_EOL);
	}

	private function getScript() : string {
		global $argv;

		return pathinfo(realpath($argv[0]), PATHINFO_BASENAME);
	}

}
