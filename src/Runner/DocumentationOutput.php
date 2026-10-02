<?php

namespace donatj\MDDoc\Runner;

interface DocumentationOutput {

	public function write( string $target, callable $render ) : bool;

}
