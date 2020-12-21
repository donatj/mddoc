<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Runner\ImmutableAttributeTree;
use donatj\MDDom\Paragraph;

/**
 * Class Text
 *
 * @package donatj\MDDoc\Documentation
 */
class Text extends AbstractDocPart {

	protected $text;

	public function __construct( ImmutableAttributeTree $attributeTree, array $options, array $tree_options, ?string $text = '' ) {
		$this->text = $text;

		parent::__construct($attributeTree, $options, $tree_options);
	}

	public function output( int $depth ) {
		return new Paragraph($this->text);
	}

	protected function init() : void { }

}
