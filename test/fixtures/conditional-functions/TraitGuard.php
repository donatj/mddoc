<?php

namespace MDDocTest;

if( !trait_exists(ConditionallyDeclaredTrait::class) ) {
	/** Documents a conditionally declared trait. */
	trait ConditionallyDeclaredTrait {
	}
}
