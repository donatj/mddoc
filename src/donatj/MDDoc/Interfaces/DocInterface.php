<?php

namespace donatj\MDDoc\Interfaces;

interface DocInterface {

	/**
	 * @param int $depth
	 * @return string
	 */
	public function output( $depth );

} 