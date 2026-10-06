<?php

namespace Example\EnumDependencies;

interface StateContract {

	/** Returns the value required by the contract. */
	public function contractValue() : string;

}
