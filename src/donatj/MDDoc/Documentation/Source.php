<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\PathNotReadableException;

/**
 * Class Source
 *
 * @package donatj\MDDoc\Documentation
 */
class Source extends Text {

	/**
	 * @param int $depth
	 * @return string
	 * @throws \donatj\MDDoc\Exceptions\PathNotReadableException
	 */
	public function output( $depth ) {

		$name = $this->getOption('name');
		$lang = $this->getOption('lang');

		$text = ($name ? file_get_contents($name) : $this->text);

		if( $name && !is_readable($name) ) {
			throw new PathNotReadableException("{$name} not readable.");
		}

		return "```" . ($lang ? : '') . "\n" . $text . "\n```\n\n";

	}

}
