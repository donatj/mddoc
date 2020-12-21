<?php

namespace donatj\MDDoc\Runner;

class ImmutableAttributeTree {

	private const TAG  = 'tag';
	private const ATTR = 'attr';

	private $attributeCollection = [];

	public function withAttr( string $tagName, array $attributes ) : self {
		$tree = clone $this;

		array_unshift($tree->attributeCollection, [
			self::TAG  => strtolower($tagName),
			self::ATTR => $attributes,
		]);

		return $tree;
	}

	public function shallowValue( string $attr ) : ?string {
		return $this->attributeCollection[0][self::ATTR][$attr] ?? null;
	}

	public function deepValue( string $attr ) : ?string {
		foreach( $this->attributeCollection as $attribute ) {
			if( isset($attribute[self::ATTR][$attr]) ) {
				return $attribute[self::ATTR][$attr];
			}
		}

		return null;
	}

}
