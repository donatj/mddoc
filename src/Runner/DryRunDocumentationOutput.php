<?php

namespace donatj\MDDoc\Runner;

use Psr\Log\LoggerInterface;

class DryRunDocumentationOutput implements DocumentationOutput {

	private LoggerInterface $logger;
	private bool $hasMismatches = false;

	public function __construct( LoggerInterface $logger ) {
		$this->logger = $logger;
	}

	public function prepare( string $target ) : void {
	}

	public function write( string $target, string $markdown ) : void {
		if( @file_get_contents($target) !== $markdown ) {
			$this->hasMismatches = true;
			$this->logger->warning("dry run: output '{$target}' differs");
		}
	}

	public function getExitCode() : int {
		return (int)$this->hasMismatches;
	}

}
