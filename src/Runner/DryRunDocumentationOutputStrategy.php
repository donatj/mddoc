<?php

namespace donatj\MDDoc\Runner;

use donatj\MDDoc\Exceptions\DryRunMismatchException;

class DryRunDocumentationOutputStrategy implements DocumentationOutputStrategy {

	/** @param callable(): string $render */
	public function write( string $target, callable $render ) : bool {
		$markdown = $render();

		if( !is_file($target) || @file_get_contents($target) !== $markdown ) {
			throw new DryRunMismatchException($target);
		}

		return true;
	}

}
