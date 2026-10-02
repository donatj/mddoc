<?php

namespace donatj\MDDoc\Runner;

interface DocumentationOutput {

	/** @param callable(): string $render */
	public function write( string $target, callable $render ) : bool;

}
