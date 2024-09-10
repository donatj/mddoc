<?php

/**
 * Documentation page - stores the contents of child elements to a file
 *
 * Nesting docpages results in a link being added in the parent page to the child page
 *
 * Inherits all attributes from `<file>`
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Exceptions\TargetNotWritableException;
use donatj\MDDom\Document;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class DocPage extends AbstractNestedDoc implements LoggerAwareInterface {

	use LoggerAwareTrait;

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

		if( (is_file($target) && !is_writable($target)) || !$this->recursiveTouch($target) ) {
			throw new TargetNotWritableException("Path '{$target}' not writable");
		}

		foreach( $this->getDocumentationChildren() as $child ) {
			$output = $child->output(0);
			if( $output === null ) {
				throw new ConfigException(get_class($child) . ' incorrectly used as a nested element');
			}

			$document->appendChild($output);
		}

		if( @file_put_contents($target, $document->exportMarkdown(-1)) === false ) {
			throw new TargetNotWritableException("failed to write to '{$target}'");
		}

		if( $this->logger ) {
			$this->logger->info("output '{$target}'");
		}

		return "{$pre_link_text}[{$link_text}]({$link}){$post_link_text}\n\n";
	}

	private function recursiveTouch( string $new, ?int $time = null ) : bool {
		if( $time === null ) {
			$time = time();
		}

		if( $new[0] !== '/' && $new[0] !== '.' ) {
			$new = realpath('.') . '/' . $new;
		}

		$dirs = explode('/', $new);
		array_pop($dirs);

		$path = '';
		array_filter($dirs);
		foreach( $dirs as $dir ) {
			$path .= '/' . $dir;
			if( !is_dir($path) ) {
				if( !mkdir($path) && !is_dir($path) ) {
					return false;
				}
			}
		}

		return touch($new, $time);
	}

	protected function init() : void {
		$this->requireOption(self::OPT_TARGET);
	}

	public static function tagName() : string {
		return 'docpage';
	}

}
