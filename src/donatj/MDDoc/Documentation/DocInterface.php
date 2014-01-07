<?php

namespace donatj\MDDoc\Documentation;

interface DocInterface {

	/**
	 * @param int $depth
	 * @return string
	 */
	public function output( $depth );

} 