<?php

namespace donatj\MDDoc\Documentation\Interfaces;

use donatj\MDDoc\Runner\ImmutableAttributeTree;

interface ElementInterface {

	public function __construct( ImmutableAttributeTree $attributeTree, string $textContent );

	/**
	 * Get the canonical xml tag name for this documentor
	 *
	 * @internal
	 */
	public static function tagName() : string;

}
