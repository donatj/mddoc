<?php

namespace donatj\MDDoc\Runner;

interface DocumentationOutput {

	public function prepare( string $target ) : void;

	public function write( string $target, string $markdown ) : void;

	public function getExitCode() : int;

}
