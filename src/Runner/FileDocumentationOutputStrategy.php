<?php

namespace donatj\MDDoc\Runner;

use Psr\Log\LoggerInterface;

class FileDocumentationOutputStrategy implements DocumentationOutputStrategy {

	private LoggerInterface $logger;

	public function __construct( LoggerInterface $logger ) {
		$this->logger = $logger;
	}

	/** @param callable(): string $render */
	public function write( string $target, callable $render ) : bool {
		if( (is_file($target) && !is_writable($target)) || !$this->recursiveTouch($target) ) {
			return false;
		}

		$markdown = $render();

		if( @file_put_contents($target, $markdown) === false ) {
			return false;
		}

		$this->logger->info("output '{$target}'");

		return true;
	}

	private function recursiveTouch( string $new, ?int $time = null ) : bool {
		if( $time === null ) {
			$time = time();
		}

		if( $new[0] !== '/' && $new[0] !== '.' ) {
			$new = realpath('.') . '/' . $new;
		}

		$dirs = explode('/', $new);
		array_pop($dirs);

		$path = '';
		foreach( $dirs as $dir ) {
			$path .= '/' . $dir;
			if( !is_dir($path) ) {
				if( !mkdir($path) && !is_dir($path) ) {
					return false;
				}
			}
		}

		return touch($new, $time);
	}

}
