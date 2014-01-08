<?php

namespace donatj\MDDoc\Documentation\Interfaces;

interface DocumentationInterface {

	/**
	 * @param int $depth
	 * @return string
	 */
	public function output( $depth );

} 