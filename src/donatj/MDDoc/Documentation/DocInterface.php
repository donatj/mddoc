<?php

namespace donatj\MDDoc\Documentation;

interface DocInterface {

	public function __construct($depth);

	public function getMarkdown();

} 