<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDom\Paragraph;

class IncludeFile extends AbstractDocPart {

	/**
	 * @throws \donatj\MDDoc\Exceptions\PathNotReadableException
	 */
	public function output( int $depth ) : Paragraph {
		$name = $this->getOption('name');
		$file = $this->getWorkingFilePath($name);

		return new Paragraph(file_get_contents($file));
	}

	protected function init() : void {
		$this->requireOption('name');
	}

}
