<?php

function declareLocalClass() : void {
	class LocalClass {

		/** Documents a method on the local class. */
		public function localMethod() : void {
		}

	}
}

class MainClass {

	/** Documents a method on the top-level class. */
	public function mainMethod() : void {
	}

}
