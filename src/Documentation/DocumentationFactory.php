<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation;
use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Runner\ImmutableAttributeTree;

/**
 * Links XML Tags to their Given Documentation Generator
 *
 * @package donatj\MDDoc\Documentation
 */
class DocumentationFactory {

	/**
	 * Return a populated DocumentationInterface of the corresponding tagName
	 *
	 * @param string                                      $tagName
	 * @param \donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree
	 * @param array                                       $attributes
	 * @param array                                       $childAttributeTree
	 * @param string                                      $textContent
	 * @return \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface
	 */
	public function makeFromTag( string $tagName, ImmutableAttributeTree $attributeTree, array $attributes, array $childAttributeTree, string $textContent ) : DocumentationInterface {
		$tagName = strtolower($tagName);

		switch( $tagName ) {
			case 'section':
				return new Documentation\Section($attributeTree, $attributes, $childAttributeTree);
			case 'docpage':
				return new Documentation\DocPage($attributeTree, $attributes, $childAttributeTree);
			case 'text':
				return new Documentation\Text($attributeTree, $attributes, $childAttributeTree, $textContent);
			case 'file':
				return new Documentation\ClassFile($attributeTree, $attributes, $childAttributeTree);
			case 'recursivedirectory': // Deprecated tag name
			case 'recursive-directory':
				return new Documentation\RecursiveDirectory($attributeTree, $attributes, $childAttributeTree);
			case 'include':
				return new Documentation\IncludeFile($attributeTree, $attributes, $childAttributeTree);
			case 'source':
				return new Documentation\Source($attributeTree,$attributes,  $childAttributeTree, $textContent);
			case 'composer-install':
				return new Documentation\ComposerInstall($attributeTree, $attributes, $childAttributeTree);
			case 'composer-requires':
				return new Documentation\ComposerRequires($attributeTree, $attributes, $childAttributeTree);
			case 'badge':
				return new Documentation\Badges\Badge($attributeTree, $attributes, $childAttributeTree);
			case 'badge-poser':
				return new Documentation\Badges\BadgePoser($attributeTree, $attributes, $childAttributeTree);
			case 'badge-travis':
				return new Documentation\Badges\BadgeTravis($attributeTree, $attributes, $childAttributeTree);
			case 'badge-scrutinizer':
				return new Documentation\Badges\BadgeScrutinizer($attributeTree, $attributes, $childAttributeTree);
			case 'badge-github-action':
				return new Documentation\Badges\BadgeGitHubActions($attributeTree, $attributes, $childAttributeTree);
			case 'exec':
				return new Documentation\ExecOutput($attributeTree, $attributes, $childAttributeTree);
		}

		throw new ConfigException("Unhandled XML Tag: {$tagName}");
	}

}
