<?php

namespace donatj\MDDoc\Runner;

use CLI\Style;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;

class TextUI implements LoggerInterface {

	use LoggerTrait;

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
	 * @param string      $text       Primary error log details
	 * @param int         $code       Status code to exit with (0-255)
	 * @param string|null $additional Optional - will print on a second line following the log
	 */
	public function dropError( string $text, int $code = 1, ?string $additional = null ) : void {
		fwrite($this->STDERR, $this->getScript() . ": " . Style::red($text) . PHP_EOL . ($additional ? $additional . PHP_EOL : ''));

		die($code);
	}

	public function println( string $text = '' ) : void {
		fwrite($this->STDOUT, $text . PHP_EOL);
	}

	public function log( $level, $message, array $context = [] ) : void {
		fwrite($this->STDERR, date('c '));

		if( !is_string($level) ) {
			$level = var_export($level, true);
		}

		switch( $level ) {
			case LogLevel::DEBUG:
				fwrite($this->STDERR, Style::cyan('DEBUG '));
				break;
			case LogLevel::INFO:
				fwrite($this->STDERR, Style::green('INFO '));
				break;
			case LogLevel::NOTICE:
				fwrite($this->STDERR, Style::blue('NOTICE '));
				break;
			case LogLevel::WARNING:
				fwrite($this->STDERR, Style::yellow('WARNING '));
				break;
			case LogLevel::CRITICAL:
			case LogLevel::ALERT:
			case LogLevel::EMERGENCY:
			case LogLevel::ERROR:
				fwrite($this->STDERR, Style::red(strtoupper("{$level} ")));
				break;
			default:
				fwrite($this->STDERR, "{$level} ");
		}

		fwrite($this->STDERR, $message);
		fwrite($this->STDERR, PHP_EOL);

		foreach( $context as $key => $value ) {
			if( !is_string($value) ) {
				$value = var_export($value, true);
			}

			fwrite($this->STDERR, "  {$key}: {$value}" . PHP_EOL);
		}
	}

	private function getScript() : string {
		global $argv;

		$path = realpath($argv[0]);
		if( $path === false ) {
			throw new \RuntimeException("Could not determine script path");
		}

		return pathinfo($path, PATHINFO_BASENAME);
	}

}
