<?php

namespace MDDocTest;

if( !enum_exists(ConditionallyDeclaredEnum::class) ) {
	/** Documents a conditionally declared enum. */
	enum ConditionallyDeclaredEnum {

		case Available;

	}
}
