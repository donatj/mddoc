<?php

/**
 * Include either raw or cdata text content
 *
 * Example:
 *
 * ```xml
 * <text>Some Text</text>
 * <text><![CDATA[Some Text]]></text>
 * ```
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDom\AbstractElement;
use donatj\MDDom\Paragraph;

class Text extends AbstractDocPart {

	public function output( int $depth ) : AbstractElement {
		return new Paragraph($this->getTextContent());
	}

	protected function init() : void { }

	public static function tagName() : string {
		return 'text';
	}

}
