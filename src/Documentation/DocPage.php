<?php

/**
 * Documentation page - stores the contents of child elements to a file
 *
 * Nesting docpages results in a link being added in the parent page to the child page
 *
 * Inherits all attributes from `<file>`
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Interfaces\DocumentationOutputStrategyAware;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Exceptions\MDDocException;
use donatj\MDDoc\Runner\DocumentationOutputStrategy;
use donatj\MDDom\Document;

class DocPage extends AbstractNestedDoc implements DocumentationOutputStrategyAware {

	private DocumentationOutputStrategy $documentationOutputStrategy;

	/**
	 * Filename to output
	 *
	 * @mddoc-required
	 */
	public const OPT_TARGET = 'target';
	/** Optional custom link for parent documents */
	public const OPT_LINK = 'link';
	/** Optional custom text for the link in parent documents */
	public const OPT_LINK_TEXT = 'link-text';
	/** Optional custom text to precede the link in parent documents */
	public const OPT_LINK_PRE_TEXT = 'link-pre-text';
	/** Optional custom text to follow the link in parent documents */
	public const OPT_LINK_POST_TEXT = 'link-post-text';

	public function output( int $depth ) : string {

		$document = new Document;

		$target         = $this->requireOption(self::OPT_TARGET);
		$link           = $this->getOption(self::OPT_LINK) ?: $target;
		$link_text      = $this->getOption(self::OPT_LINK_TEXT) ?: "See: {$link}";
		$pre_link_text  = $this->getOption(self::OPT_LINK_PRE_TEXT) ?: '';
		$post_link_text = $this->getOption(self::OPT_LINK_POST_TEXT) ?: '';

		if( !$this->documentationOutputStrategy->write($target, function () use( $document ) : string {
			foreach( $this->getDocumentationChildren() as $child ) {
				$output = $child->output(0);
				if( $output === null ) {
					throw new ConfigException(get_class($child) . ' incorrectly used as a nested element');
				}

				$document->appendChild($output);
			}

			return $document->exportMarkdown(-1);
		}) ) {
			throw new MDDocException("output '{$target}' differs");
		}

		return "{$pre_link_text}[{$link_text}]({$link}){$post_link_text}\n\n";
	}

	public function setDocumentationOutputStrategy( DocumentationOutputStrategy $documentationOutputStrategy ) : void {
		$this->documentationOutputStrategy = $documentationOutputStrategy;
	}

	protected function init() : void {
		$this->requireOption(self::OPT_TARGET);
	}

	public static function tagName() : string {
		return 'docpage';
	}

}
