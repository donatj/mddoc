<?php

namespace donatj\MDDoc\Reflectors\Source;

/** @mddoc-ignore */
class Element {

	/** @var string */
	private $name;

	/** @var string */
	private $fqsen;

	/** @var DocBlock|null */
	private $docBlock;

	/** @var string */
	private $visibility;

	/** @var bool */
	private $static;

	/** @var Argument[] */
	private $arguments;

	/** @var string */
	private $returnType;

	/** @var string|null */
	private $value;

	/**
	 * @param Argument[] $arguments
	 */
	public function __construct(
		string $name,
		string $fqsen,
		?DocBlock $docBlock = null,
		string $visibility = 'public',
		bool $static = false,
		array $arguments = [],
		string $returnType = 'mixed',
		?string $value = null
	) {
		$this->name       = $name;
		$this->fqsen      = $fqsen;
		$this->docBlock   = $docBlock;
		$this->visibility = $visibility;
		$this->static     = $static;
		$this->arguments  = $arguments;
		$this->returnType = $returnType;
		$this->value      = $value;
	}

	public function getName() : string {
		return $this->name;
	}

	public function getFqsen() : string {
		return $this->fqsen;
	}

	public function getDocBlock() : ?DocBlock {
		return $this->docBlock;
	}

	public function getVisibility() : string {
		return $this->visibility;
	}

	public function isStatic() : bool {
		return $this->static;
	}

	/**
	 * @return Argument[]
	 */
	public function getArguments() : array {
		return $this->arguments;
	}

	public function getReturnType() : string {
		return $this->returnType;
	}

	public function getValue() : ?string {
		return $this->value;
	}

	public function getDefault() : ?string {
		return $this->value;
	}

}
