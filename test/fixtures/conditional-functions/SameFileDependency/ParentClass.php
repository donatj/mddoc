<?php

namespace MDDocTest\SameFileDependency;

class ParentClass {

	/** Documents a method inherited by the local class. */
	public function parentMethod() : void {
	}

}

function declareChildClass() : void {
	class ChildClass extends \MDDocTest\SameFileDependency\ParentClass {

		/** Documents a method defined by the local class. */
		public function childMethod() : void {
		}

	}
}
