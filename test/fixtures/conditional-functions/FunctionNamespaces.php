<?php

namespace MDDocTest\First;

function shared_helper() : void {
}

namespace MDDocTest\Second;

function outer_function() : void {
	function shared_helper() : void {
	}
}
