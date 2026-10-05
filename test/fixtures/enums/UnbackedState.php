<?php

namespace MDDocTest;

/** An enum without a backing type. */
enum UnbackedState {

	/** A label for the enum. */
	public const LABEL = 'unbacked state';

	/** Work has not started. */
	case Pending;

	/** Work has completed. */
	case Complete;

}
