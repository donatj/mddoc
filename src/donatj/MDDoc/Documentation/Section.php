<?php

namespace donatj\MDDoc\Documentation;

class Section extends AbstractNestedDoc {

	public function output( $depth ) {
		$title = $this->getOption('title');

		$output = str_repeat('#', $depth + 1) . " {$title}\n\n";

		foreach( $this->getChildren() as $child ) {
			$output .= $child->output($depth + 1);
		}

		return $this->cleanup($output);
	}

	protected function init() {
		$this->requireOptions('title');
	}

}