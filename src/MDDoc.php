<?php

namespace donatj\MDDoc;

use donatj\Flags;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Exceptions\MDDocException;
use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDoc\Runner\ConfigParser;
use donatj\MDDoc\Runner\TextUI;

/**
 * Application MDDoc
 */
class MDDoc {

	public const VERSION = "0.1.0";

	private const CONFIG_FILES = [
		"mddoc.xml",
		".mddoc.xml",
		"mddoc.xml.dist",
		".mddoc.xml.dist",
	];

	/**
	 * @param string[] $args
	 */
	public function __construct( array $args ) {
		$start = microtime(true);

		$ui = new TextUI(STDOUT, STDERR);

		self::versionMarker($ui);

		try {
			$config = $this->init($args, $ui);
			$parser = new ConfigParser(
				new ElementFactory($ui), $ui
			);

			$doc = $parser->parse($config);

			$doc->output(0);
		} catch( ConfigException $e ) {
			$ui->dropError("Configuration error; " . $e->getMessage());
		} catch( PathNotReadableException $e ) {
			$ui->dropError("Path/File Not Readable " . $e->getPath());
		} catch( MDDocException $e ) {
			$ui->dropError("Error: " . $e->getMessage());
		}

		$currMen = number_format(memory_get_usage() / 1048576, 2);
		$peakMem = number_format(memory_get_peak_usage() / 1048576, 2);
		$time    = number_format(microtime(true) - $start, 3);

		$ui->debug("[{$currMen}mb]{$peakMem}mb peak mem - {$time}s exec time");
	}

	/**
	 * @param string[] $args
	 */
	private function init( array $args, TextUI $ui ) : string {
		$flags          = new Flags;
		$displayHelp    = &$flags->bool('help', false, 'Display this help message.');
		$displayVersion = &$flags->bool('version', false, 'Display this applications version.');

		try {
			$flags->parse($args);
		} catch( \Exception $e ) {
			$ui->dropError($e->getMessage(), 1, $flags->getDefaults());
		}

		switch( true ) {
			case $displayVersion:
				self::versionMarker($ui);

				die(0);
			case $displayHelp:
			case count($flags->args()) > 1:
				$ui->dumpOptions($flags->getDefaults());

				die(1);
		}

		if( $flags->args() ) {
			return current($flags->args());
		}

		foreach( self::CONFIG_FILES as $configFile ) {
			if( file_exists($configFile) ) {
				return $configFile;
			}
		}

		throw new ConfigException('No config file found');
	}

	private static function versionMarker( TextUI $ui ) : void {
		$ui->println("MDDoc " . self::VERSION . " by Jesse G. Donat" . PHP_EOL);
	}

}
