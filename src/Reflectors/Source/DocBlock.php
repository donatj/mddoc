<?php

namespace donatj\MDDoc\Reflectors\Source;

/** @mddoc-ignore */
class DocBlock {

	private string $summary;
	private string $description;

	/** @var array<string,Tag[]> */
	private array $tags;

	/** @var array<string,true> */
	private array $typeNames;

	/**
	 * @param array<string,Tag[]> $tags
	 * @param array<string,true> $typeNames
	 */
	public function __construct( string $summary, string $description, array $tags, array $typeNames ) {
		$this->summary     = $summary;
		$this->description = $description;
		$this->tags        = $tags;
		$this->typeNames   = $typeNames;
	}

	public function getSummary() : string {
		return $this->summary;
	}

	public function getDescription() : string {
		return $this->description;
	}

	/**
	 * @return Tag[]
	 */
	public function getTagsByName( string $name ) : array {
		return $this->tags[$name] ?? [];
	}

	/** @return array<string,true> */
	public function getTypeNames() : array {
		return $this->typeNames;
	}

}
