<?php

namespace MDDocTest;

if( !interface_exists(ConditionallyDeclaredInterface::class) ) {
	/** Documents a conditionally declared interface. */
	interface ConditionallyDeclaredInterface {
	}
}
