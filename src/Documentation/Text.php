<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Runner\ImmutableAttributeTree;
use donatj\MDDom\AbstractElement;
use donatj\MDDom\Paragraph;

/**
 * Class Text
 */
class Text extends AbstractDocPart {

	protected $text;

	public function __construct( ImmutableAttributeTree $attributeTree, string $text = '' ) {
		$this->text = $text;

		parent::__construct($attributeTree);
	}

	public function output( int $depth ) : AbstractElement {
		return new Paragraph($this->text);
	}

	protected function init() : void { }

}
