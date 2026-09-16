<?php

namespace donatj\MDDoc\Reflectors\Source;

/** @mddoc-ignore */
class DocBlock {

	/** @var string */
	private $summary;

	/** @var string */
	private $description;

	/** @var array<string,Tag[]> */
	private $tags;

	/**
	 * @param array<string,Tag[]> $tags
	 */
	public function __construct( string $summary, string $description, array $tags ) {
		$this->summary     = $summary;
		$this->description = $description;
		$this->tags        = $tags;
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

}
