<?php

namespace donatj\MDDoc\Runner;

class DryRunResult {

	private bool $hasMismatches = false;

	public function markMismatch() : void {
		$this->hasMismatches = true;
	}

	public function hasMismatches() : bool {
		return $this->hasMismatches;
	}

}
