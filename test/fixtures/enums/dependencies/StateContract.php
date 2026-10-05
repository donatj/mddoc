<?php

namespace MDDocTest\EnumDependencies;

interface StateContract {

	/** Returns the value required by the contract. */
	public function contractValue() : string;

}
