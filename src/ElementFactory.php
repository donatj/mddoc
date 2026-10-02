<?php

namespace donatj\MDDoc;

use donatj\MDDoc\Documentation\Interfaces\DocumentationOutputStrategyAware;
use donatj\MDDoc\Documentation\Interfaces\ElementInterface;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Runner\DocumentationOutputStrategy;
use donatj\MDDoc\Runner\ImmutableAttributeTree;
use donatj\MDDoc\Runner\TextUI;
use Psr\Log\LoggerAwareInterface;

/**
 * Links XML Tags to their Given Documentation Generator
 */
class ElementFactory {

	private TextUI $ui;
	private DocumentationOutputStrategy $documentationOutputStrategy;

	/**
	 * ElementFactory constructor.
	 */
	public function __construct( TextUI $ui, DocumentationOutputStrategy $documentationOutputStrategy ) {
		$this->ui                          = $ui;
		$this->documentationOutputStrategy = $documentationOutputStrategy;
	}

	public const DEFAULT_ELEMENTS = [
		Documentation\Autoloader::class,

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
		Documentation\Badges\BadgeCoveralls::class,
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
	) : ElementInterface {
		$tagName = strtolower($tagName);

		switch( $tagName ) {
			case 'recursivedirectory': // Deprecated tag name
				$this->ui->warning(sprintf("The 'recursivedirectory' tag is deprecated, use '%s' instead.", Documentation\RecursiveDirectory::tagName()));
				$tagName = Documentation\RecursiveDirectory::tagName();
				break;
		}

		foreach( self::DEFAULT_ELEMENTS as $element ) {
			if( !is_subclass_of($element, ElementInterface::class) ) {
				throw new ConfigException("{$element} does not implement " . ElementInterface::class);
			}

			if( $element::tagName() === $tagName ) {
				$element = new $element($attributeTree, $textContent);
				if( $element instanceof LoggerAwareInterface ) {
					$element->setLogger($this->ui);
				}

				if( $element instanceof DocumentationOutputStrategyAware ) {
					$element->setDocumentationOutputStrategy($this->documentationOutputStrategy);
				}

				return $element;
			}
		}

		throw new ConfigException("Unhandled XML Tag: '{$tagName}'");
	}

}
