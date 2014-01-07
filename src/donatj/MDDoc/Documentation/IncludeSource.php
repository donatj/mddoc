<?php

namespace donatj\MDDoc\Documentation;

class IncludeSource extends IncludeFile {

	/**
	 * @var string
	 */
	private $lang = '';

	function __construct($name, $lang = null) {
		parent::__construct($name);

		if( $lang ) {
			$this->lang = $lang;
		}
	}


	/**
	 * @param int $depth
	 * @return string
	 */
	public function output( $depth ) {
		return "```\n" . file_get_contents($this->name) . "\n```\n\n`";
	}

}
