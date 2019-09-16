<?php

namespace donatj\MDDoc\Documentation\Interfaces;

use donatj\MDDom\AbstractElement;

interface DocumentationInterface {

	public function __construct( array $options, array $tree_options );

	/**
	 * @return AbstractElement|string Cannot be annotated as also accepts __toString-able objects
	 */
	public function output( int $depth );

}
