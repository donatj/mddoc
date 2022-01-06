<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\ConfigException;

class Replace extends AbstractNestedDoc {

	public const OPT_SEARCH  = 'search';
	public const OPT_REPLACE = 'replace';
	public const OPT_REGEX   = 'regex';

	public function output( int $depth ) : string {
		$regex = $this->getOption(self::OPT_REGEX);
		$regex = strtolower($regex);

		$output = '';
		foreach( $this->getChildren() as $child ) {
			$result = $child->output($depth);
			if( is_string($result) ) {
				$output .= $result;
			} else {
				$output .= $result->exportMarkdown($depth);
			}
		}

		$search  = $this->getOption(self::OPT_SEARCH);
		$replace = $this->getOption(self::OPT_REPLACE);

		if( $regex === 'true' ) {
			$output = preg_replace($search, $replace, $output);
			if( preg_last_error() !== PREG_NO_ERROR ) {
				throw new ConfigException("user regex error: " . preg_last_error_msg());
			}

			return $output;
		}

		return str_replace($search, $replace, $output);
	}

	protected function init() : void {
		$this->requireOption(self::OPT_SEARCH);
		$this->requireOption(self::OPT_REPLACE);

		$this->setOptionDefault(self::OPT_REGEX, 'false');
	}

}
