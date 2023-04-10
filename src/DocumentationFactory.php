<?php

namespace donatj\MDDoc;

use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Documentation\Interfaces\UIAwareDocumentationInterface;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Runner\ImmutableAttributeTree;
use donatj\MDDoc\Runner\TextUI;

/**
 * Links XML Tags to their Given Documentation Generator
 */
class DocumentationFactory {

	/** @var \donatj\MDDoc\Runner\TextUI */
	private $ui;

	/**
	 * DocumentationFactory constructor.
	 */
	public function __construct( TextUI $ui ) {
		$this->ui = $ui;
	}

	public const DEFAULT_DOCUMENTORS = [
		Documentation\Section::class,
		Documentation\Replace::class,
		Documentation\DocPage::class,
		Documentation\Text::class,
		Documentation\PhpFileDocs::class,
		Documentation\RecursiveDirectory::class,
		Documentation\IncludeFile::class,
		Documentation\Source::class,
		Documentation\ComposerInstall::class,
		Documentation\ComposerRequires::class,
		Documentation\Badges\Badge::class,
		Documentation\Badges\BadgePoser::class,
		Documentation\Badges\BadgeTravis::class,
		Documentation\Badges\BadgeScrutinizer::class,
		Documentation\Badges\BadgeShielded::class,
		Documentation\Badges\BadgeGitHubActions::class,
		Documentation\ExecOutput::class,
	];

	/**
	 * Return a populated DocumentationInterface of the corresponding tagName
	 */
	public function makeFromTag(
		string $tagName,
		ImmutableAttributeTree $attributeTree,
		string $textContent
	) : DocumentationInterface {
		$tagName = strtolower($tagName);

		switch( $tagName ) {
			case 'recursivedirectory': // Deprecated tag name
				$this->ui->warning(sprintf("The 'recursivedirectory' tag is deprecated, use '%s' instead.", Documentation\RecursiveDirectory::tagName()));
				$tagName = Documentation\RecursiveDirectory::tagName();
				break;
		}

		foreach( self::DEFAULT_DOCUMENTORS as $documentor ) {
			if( !is_subclass_of($documentor, DocumentationInterface::class) ) {
				throw new ConfigException("{$documentor} does not implement " . DocumentationInterface::class);
			}

			if( $documentor::tagName() === $tagName ) {
				$element = new $documentor($attributeTree, $textContent);
				if( $element instanceof UIAwareDocumentationInterface ) {
					$element->setUI($this->ui);
				}

				return $element;
			}
		}

		throw new ConfigException("Unhandled XML Tag: '{$tagName}'");
	}

}
