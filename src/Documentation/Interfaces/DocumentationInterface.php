<?php

namespace donatj\MDDoc\Documentation\Interfaces;

interface DocumentationInterface {

	public function __construct( array $options, array $tree_options );

	/**
	 * @param int $depth
	 * @return string Cannot be annotated as also accepts __toString-able objects
	 */
	public function output( int $depth );

}
