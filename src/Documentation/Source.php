<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDom\CodeBlock;

/**
 * Class Source
 *
 * @package donatj\MDDoc\Documentation
 */
class Source extends Text {

	/**
	 * @return string
	 * @throws \donatj\MDDoc\Exceptions\PathNotReadableException
	 */
	public function output( int $depth ) {
		$name = $this->getOption('name');
		$lang = $this->getOption('lang');

		if( $name && !is_readable($name) ) {
			throw new PathNotReadableException('Path not readable.', $name);
		}

		$text = ($name ? file_get_contents($name) : $this->text);

		return new CodeBlock($text, $lang);
	}

}
