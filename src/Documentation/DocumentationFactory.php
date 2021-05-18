<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation;
use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Runner\ImmutableAttributeTree;

/**
 * Links XML Tags to their Given Documentation Generator
 */
class DocumentationFactory {

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
			case 'section':
				return new Documentation\Section($attributeTree);
			case 'docpage':
				return new Documentation\DocPage($attributeTree);
			case 'text':
				return new Documentation\Text($attributeTree, $textContent);
			case 'file':
				return new Documentation\ClassFile($attributeTree);
			case 'recursivedirectory': // Deprecated tag name
			case 'recursive-directory':
				return new Documentation\RecursiveDirectory($attributeTree);
			case 'include':
				return new Documentation\IncludeFile($attributeTree);
			case 'source':
				return new Documentation\Source($attributeTree, $textContent);
			case 'composer-install':
				return new Documentation\ComposerInstall($attributeTree);
			case 'composer-requires':
				return new Documentation\ComposerRequires($attributeTree);
			case 'badge':
				return new Documentation\Badges\Badge($attributeTree);
			case 'badge-poser':
				return new Documentation\Badges\BadgePoser($attributeTree);
			case 'badge-travis':
				return new Documentation\Badges\BadgeTravis($attributeTree);
			case 'badge-scrutinizer':
				return new Documentation\Badges\BadgeScrutinizer($attributeTree);
			case 'badge-github-action':
				return new Documentation\Badges\BadgeGitHubActions($attributeTree);
			case 'exec':
				return new Documentation\ExecOutput($attributeTree);
		}

		throw new ConfigException("Unhandled XML Tag: {$tagName}");
	}

}
