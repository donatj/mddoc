<?php

namespace donatj\MDDoc\Documentation;

class IncludeSource extends IncludeFile {

	/**
	 * @param int $depth
	 * @return string
	 */
	public function output( $depth ) {

		$name = $this->getOption('name');
		$lang = $this->getOption('lang');

		return "```" . ($lang ? : '') . "\n" . file_get_contents($name) . "\n```\n\n";

	}

}
