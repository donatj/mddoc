<?php

namespace donatj\MDDoc\Documentation\Interfaces;

use donatj\MDDom\AbstractElement;

interface DocumentationInterface extends ElementInterface {

	/**
	 * @return AbstractElement|string Cannot be annotated as also accepts __toString-able objects
	 */
	public function output( int $depth );

}
