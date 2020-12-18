<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation;
use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Exceptions\ConfigException;

/**
 * Links XML Tags to their Given Documentation Generator
 *
 * @package donatj\MDDoc\Documentation
 */
class DocumentationFactory {

	/**
	 * Return a populated DocumentationInterface of the corresponding tagName
	 */
	public function makeFromTag( string $tagName, array $attributes, array $childAttributeTree, string $textContent ) : DocumentationInterface {
		$tagName = strtolower($tagName);

		switch( $tagName ) {
			case 'section':
				return new Documentation\Section($attributes, $childAttributeTree);
			case 'docpage':
				return new Documentation\DocPage($attributes, $childAttributeTree);
			case 'text':
				return new Documentation\Text($attributes, $childAttributeTree, $textContent);
			case 'file':
				return new Documentation\ClassFile($attributes, $childAttributeTree);
			case 'recursivedirectory': // Deprecated tag name
			case 'recursive-directory':
				return new Documentation\RecursiveDirectory($attributes, $childAttributeTree);
			case 'include':
				return new Documentation\IncludeFile($attributes, $childAttributeTree);
			case 'source':
				return new Documentation\Source($attributes, $childAttributeTree, $textContent);
			case 'composer-install':
				return new Documentation\ComposerInstall($attributes, $childAttributeTree);
			case 'composer-requires':
				return new Documentation\ComposerRequires($attributes, $childAttributeTree);
			case 'badge':
				return new Documentation\Badges\Badge($attributes, $childAttributeTree);
			case 'badge-poser':
				return new Documentation\Badges\BadgePoser($attributes, $childAttributeTree);
			case 'badge-travis':
				return new Documentation\Badges\BadgeTravis($attributes, $childAttributeTree);
			case 'badge-scrutinizer':
				return new Documentation\Badges\BadgeScrutinizer($attributes, $childAttributeTree);
			case 'badge-github-action':
				return new Documentation\Badges\BadgeGitHubActions($attributes, $childAttributeTree);
			case 'exec':
				return new Documentation\ExecOutput($attributes, $childAttributeTree);
		}

		throw new ConfigException("Unhandled XML Tag: {$tagName}");
	}

}
