<?php

if( !function_exists('conditionally_declared_function') ) {
	/**
	 * Documents a conditionally declared function.
	 *
	 * @param string $value The value to return.
	 * @return string The original value.
	 */
	function conditionally_declared_function( string $value ) : string {
		return $value;
	}
}
