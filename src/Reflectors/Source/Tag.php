<?php

namespace donatj\MDDoc\Reflectors\Source;

/** @mddoc-ignore */
class Tag {

	private string $name;
	private ?string $type;
	private string $description;
	private string $variableName;
	private string $methodName;
	private bool $static;

	/** @var array<int,array{name:string,type:string}> */
	private array $arguments;
	private bool $valid;
	private ?string $declaringClass;

	/**
	 * @param array<int,array{name:string,type:string}> $arguments
	 */
	public function __construct(
		string $name,
		?string $type = null,
		string $description = '',
		string $variableName = '',
		string $methodName = '',
		bool $static = false,
		array $arguments = [],
		bool $valid = true,
		?string $declaringClass = null
	) {
		$this->name         = $name;
		$this->type         = $type;
		$this->description  = $description;
		$this->variableName = $variableName;
		$this->methodName   = $methodName;
		$this->static       = $static;
		$this->arguments    = $arguments;
		$this->valid        = $valid;
		$this->declaringClass = $declaringClass;
	}

	public function getName() : string {
		return $this->name;
	}

	public function getType() : ?string {
		return $this->type;
	}

	public function getDescription() : string {
		return $this->description;
	}

	public function getVariableName() : string {
		return $this->variableName;
	}

	public function getMethodName() : string {
		return $this->methodName;
	}

	public function getReturnType() : string {
		return $this->type ?? 'mixed';
	}

	public function isStatic() : bool {
		return $this->static;
	}

	/**
	 * @return array<int,array{name:string,type:string}>
	 */
	public function getArguments() : array {
		return $this->arguments;
	}

	public function isValid() : bool {
		return $this->valid;
	}

	public function getDeclaringClass() : ?string {
		return $this->declaringClass;
	}

	public function withDeclaringClass( string $declaringClass ) : self {
		$tag = clone $this;
		$tag->declaringClass = $declaringClass;

		return $tag;
	}

	public function __toString() : string {
		$parts = [];
		if( $this->type !== null ) {
			$parts[] = $this->type;
		}

		if( $this->variableName !== '' ) {
			$parts[] = '$' . $this->variableName;
		}

		if( $this->description !== '' ) {
			$parts[] = $this->description;
		}

		return implode(' ', $parts);
	}

}
