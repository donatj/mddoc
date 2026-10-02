<?php

namespace donatj\MDDoc\Documentation\Interfaces;

use donatj\MDDoc\Runner\DocumentationOutput;

interface DocumentationOutputAware {

	public function setDocumentationOutput( DocumentationOutput $documentationOutput ) : void;

}
