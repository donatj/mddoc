<?php

namespace donatj\MDDoc\Documentation;

/**
 * Class Source
 *
 * @package donatj\MDDoc\Documentation
 */
class Source extends Text {

	/**
	 * @param int $depth
	 * @return string
	 */
	public function output( $depth ) {

		$name = $this->getOption('name');
		$lang = $this->getOption('lang');

		$text = ($name ? file_get_contents($name) : $this->text);

		if( $name && !is_readable($name) ) {
			throw new PathNotReadableException("{$name} not readable.");
		}

		return "```" . ($lang ? : '') . "\n" .  . "\n```\n\n";

	}

}
