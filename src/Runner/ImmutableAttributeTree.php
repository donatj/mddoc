<?php

namespace donatj\MDDoc\Runner;

/**
 * ImmutableAttributeTree is a helper for reading XML Attributes
 */
class ImmutableAttributeTree {

	private $attributeCollection = [];

	public function withAttr( array $attributes ) : self {
		$tree = clone $this;

		array_unshift($tree->attributeCollection, $attributes);

		return $tree;
	}

	/**
	 * Fetch an attribute value by key from the top-most element.
	 *
	 * @return string|null Returns null on not found.
	 */
	public function shallowValue( string $attr ) : ?string {
		return $this->attributeCollection[0][$attr] ?? null;
	}

	/**
	 * Fetch the first attribute value by key from the starting with the top-most element and working up to the root.
	 *
	 * @return string|null Returns null on not found.
	 */
	public function deepValue( string $attr ) : ?string {
		foreach( $this->attributeCollection as $attribute ) {
			if( isset($attribute[$attr]) ) {
				return $attribute[$attr];
			}
		}

		return null;
	}

}
