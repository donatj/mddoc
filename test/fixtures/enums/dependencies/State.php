<?php

namespace MDDocTest\EnumDependencies;

/** An enum with class-like dependencies. */
enum State implements StateContract {

	use StateTrait;

	case Ready;

	public function contractValue() : string {
		return 'contract';
	}

	/** Returns a value defined directly on the enum. */
	public function enumValue() : string {
		return 'enum';
	}

}
