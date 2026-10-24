<?php

namespace Example\EnumDependencies;

trait StateTrait {

	/** Returns a value provided by the trait. */
	public function traitValue() : string {
		return 'trait';
	}

}
