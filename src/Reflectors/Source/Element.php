<?php

namespace donatj\MDDoc\Reflectors\Source;

/** @mddoc-ignore */
class Element {

	private string $name;
	private string $fqsen;
	private ?DocBlock $docBlock;
	private string $visibility;
	private bool $static;

	/** @var Argument[] */
	private array $arguments;
	private string $returnType;
	private ?string $value;
	private int $inheritanceDepth;

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
		?string $value = null,
		int $inheritanceDepth = 0
	) {
		$this->name       = $name;
		$this->fqsen      = $fqsen;
		$this->docBlock   = $docBlock;
		$this->visibility = $visibility;
		$this->static     = $static;
		$this->arguments  = $arguments;
		$this->returnType = $returnType;
		$this->value      = $value;
		$this->inheritanceDepth = $inheritanceDepth;
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

	public function getInheritanceDepth() : int {
		return $this->inheritanceDepth;
	}

	public function withInheritedDepth() : self {
		$element = clone $this;
		$element->inheritanceDepth++;

		return $element;
	}

}
