<?php

function function_containing_declarations() : void {
	/** Documents a named function declared inside another function. */
	function named_function_inside_function() : void {
	}

	/** Documents a class declared inside a function. */
	class ClassInsideFunction {
	}
}
