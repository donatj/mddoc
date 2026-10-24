<?php

namespace MDDocTest\CrossFile;

class Root {

	/** Documents a method on Root. */
	public function rootMethod() : void {
	}

}

class A extends Root {

	/** Documents a method on A. */
	public function aMethod() : void {
	}

}

function declareLocalClass() : void {
	class Local extends B {

		/** Documents a method on the local class. */
		public function localMethod() : void {
		}

	}
}
