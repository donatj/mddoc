<?php

namespace donatj\MDDoc\Documentation\Interfaces;

interface DocumentationInterface {

	public function __construct( array $options, array $tree_options );

	/**
	 * @param int $depth
	 * @return string
	 */
	public function output( $depth );

} 