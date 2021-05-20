<?php

namespace donatj\MDDoc\Documentation\Interfaces;

use donatj\MDDoc\Runner\TextUI;

interface UIAwareDocumentationInterface {

	public function setUI( TextUI $ui );

}
