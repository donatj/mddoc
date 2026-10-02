<?php

namespace donatj\MDDoc\Runner;

interface DocumentationOutputStrategy {

	/** @param callable(): string $render */
	public function write( string $target, callable $render ) : bool;

}
