<?php

namespace donatj\MDDoc\Documentation\Interfaces;

use donatj\MDDoc\Runner\DocumentationOutputStrategy;

interface DocumentationOutputStrategyAware {

	public function setDocumentationOutputStrategy( DocumentationOutputStrategy $documentationOutputStrategy ) : void;

}
