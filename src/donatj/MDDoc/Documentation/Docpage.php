<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\TargetNotWritableException;

class DocPage extends AbstractNestedDoc {

	private $target;

	function __construct( $target ) {

		if( (is_file($target) && !is_writable($target)) || !touch($target) ) {
			throw new TargetNotWritableException($target . ' not writable');
		}

		$this->target = $target;
	}

	public function output($depth) {
		$output = '';
		foreach($this->getChildren() as $child) {
			$output .= $child->output($depth);
		}

		file_put_contents($this->target, $output);

		return "[See: {$this->target}]({$this->target})\n\n";
	}
}