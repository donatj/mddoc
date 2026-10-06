<?php

namespace Example;

/** An enum whose cases are separate from its class constants. */
enum State {

	/** A label for the enum. */
	public const LABEL = 'state';

	/** Work has not started. */
	case Pending;

}
