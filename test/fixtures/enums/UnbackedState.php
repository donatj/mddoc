<?php

namespace MDDocTest;

/** An enum without a backing type. */
enum UnbackedState {

	/** Work has not started. */
	case Pending;

	/** Work has completed. */
	case Complete;

}
