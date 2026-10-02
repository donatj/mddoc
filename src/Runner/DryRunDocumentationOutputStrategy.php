<?php

namespace donatj\MDDoc\Runner;

class DryRunDocumentationOutputStrategy implements DocumentationOutputStrategy {

	/** @param callable(): string $render */
	public function write( string $target, callable $render ) : bool {
		$markdown = $render();

		return @file_get_contents($target) === $markdown;
	}

}
