<?php

/**
 * Specifies an PHP autoloader to use for the documentation generation
 *
 * This autoloader is used at the current documentation level and inherited by
 * all children
 *
 * Multiple autoloaders can be specified, and they will be checked in the order
 * they are specified
 *
 * The composer type uses a Composer autoloader registered for the configuration
 * file's directory. Its vendor/autoload.php file must exist, and its loader
 * must already be registered in the current process. It finds project and
 * dependency classes without loading them.
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Runner\ImmutableAttributeTree;

class Autoloader extends AbstractElement {

	/**
	 * The type of autoloader to use: "composer", "psr0", or "psr4"
	 *
	 * @mddoc-required
	 */
	public const OPT_TYPE = 'type';
	/**
	 * The root directory of the autoloader, required for "psr0" and "psr4"
	 */
	public const OPT_ROOT = 'root';
	/** The namespace of the autoloader, only used for psr4 */
	public const OPT_NAMESPACE = 'namespace';

	public function __construct( ImmutableAttributeTree $attributeTree, string $textContent = '' ) {
		parent::__construct($attributeTree, $textContent);
	}

	public static function tagName() : string {
		return 'autoloader';
	}

	public function getType() : string {
		return $this->requireOption(self::OPT_TYPE);
	}

	public function getRoot() : string {
		return $this->requireOption(self::OPT_ROOT);
	}

	public function getNamespace() : string {
		return $this->requireOption(self::OPT_NAMESPACE);
	}

}
