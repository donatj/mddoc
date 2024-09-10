<?php

/**
 * Define a logical section of the generated documentation
 *
 * Nesting sections results in the header level being increased (h1, h2, h3, etc)
 *
 * Example:
 *
 * ```xml
 * <section title="This is an H1">
 *    <section title="This is an H2">
 *         <section title="This is an H3">
 *           <text>Some Text</text>
 *         </section>
 *    </section>
 * </section>
 * ```
 *
 * Results in:
 *
 * ```markdown
 * # This is an H1
 *
 * ## This is an H2
 *
 * ### This is an H3
 *
 * Some Text
 * ```
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDom\DocumentDepth;
use donatj\MDDom\Header;

class Section extends AbstractNestedDoc {

	/**
	 * The heading of the section
	 *
	 * @mddoc-required
	 */
	public const OPT_TITLE = 'title';

	public function output( int $depth ) : DocumentDepth {
		$title = $this->requireOption(self::OPT_TITLE);

		$document = new DocumentDepth;
		$document->appendChild(new Header($title));

		foreach( $this->getDocumentationChildren() as $child ) {
			$output = $child->output($depth + 1);
			if( $output === null ) {
				throw new ConfigException(get_class($child) . ' incorrectly used as a nested element');
			}

			$document->appendChild($output);
		}

		return $document;
	}

	protected function init() : void {
		$this->requireOption(self::OPT_TITLE);
	}

	public static function tagName() : string {
		return 'section';
	}

}
