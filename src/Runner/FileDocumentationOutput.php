<?php

namespace donatj\MDDoc\Runner;

use donatj\MDDoc\Exceptions\TargetNotWritableException;
use Psr\Log\LoggerInterface;

class FileDocumentationOutput implements DocumentationOutput {

	private LoggerInterface $logger;

	public function __construct( LoggerInterface $logger ) {
		$this->logger = $logger;
	}

	public function prepare( string $target ) : void {
		if( (is_file($target) && !is_writable($target)) || !$this->recursiveTouch($target) ) {
			throw new TargetNotWritableException("Path '{$target}' not writable");
		}
	}

	public function write( string $target, string $markdown ) : void {
		if( @file_put_contents($target, $markdown) === false ) {
			throw new TargetNotWritableException("failed to write to '{$target}'");
		}

		$this->logger->info("output '{$target}'");
	}

	public function getExitCode() : int {
		return 0;
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
		foreach( array_filter($dirs) as $dir ) {
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
