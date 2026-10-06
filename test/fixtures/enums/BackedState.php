<?php

namespace MDDocTest;

/** An enum backed by strings. */
enum BackedState : string {

	/** The item is open. */
	case Open = 'open';

	/** The item is closed. */
	case Closed = 'closed';

}
