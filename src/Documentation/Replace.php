<?php

/**
 * Replace text in the wrapped content. Optionally use a preg_replace() regex.
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\ConfigException;

class Replace extends AbstractNestedDoc {

	/**
	 * The text to search for
	 *
	 * @mddoc-required
	 */
	public const OPT_SEARCH = 'search';
	/**
	 * The text to replace with
	 *
	 * @mddoc-required
	 */
	public const OPT_REPLACE = 'replace';
	/** Whether to use a regex or not - expects "true" or "false" - defaults to "false" */
	public const OPT_REGEX = 'regex';

	public function output( int $depth ) : string {
		/** @var "true"|"false" $regex */
		$regex = $this->requireOption(self::OPT_REGEX);
		$regex = strtolower($regex);

		$output = '';
		foreach( $this->getDocumentationChildren() as $child ) {
			$result = $child->output($depth);
			if( $result === null ) {
				throw new ConfigException(get_class($child) . ' incorrectly used as a nested element');
			}

			if( is_string($result) ) {
				$output .= $result;
			} else {
				$output .= $result->exportMarkdown($depth);
			}
		}

		$search  = $this->requireOption(self::OPT_SEARCH);
		$replace = $this->requireOption(self::OPT_REPLACE);

		if( $regex === 'true' ) {
			$output = @preg_replace($search, $replace, $output);
			if( $output === null || preg_last_error() !== PREG_NO_ERROR ) {
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

	public static function tagName() : string {
		return 'replace';
	}

}
