<?php

namespace donatj\MDDoc\Reflectors\Source;

/** @mddoc-ignore */
class Argument {

	private string $name;
	private string $type;
	private ?string $default;
	private bool $variadic;

	public function __construct( string $name, string $type = 'mixed', ?string $default = null, bool $variadic = false ) {
		$this->name     = $name;
		$this->type     = $type;
		$this->default  = $default;
		$this->variadic = $variadic;
	}

	public function getName() : string {
		return $this->name;
	}

	public function getType() : string {
		return $this->type;
	}

	public function getDefault() : ?string {
		return $this->default;
	}

	public function isVariadic() : bool {
		return $this->variadic;
	}

}
