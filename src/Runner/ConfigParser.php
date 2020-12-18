<?php

namespace donatj\MDDoc\Runner;

use donatj\MDDoc\Autoloaders\NullLoader;
use donatj\MDDoc\Autoloaders\Psr0;
use donatj\MDDoc\Autoloaders\Psr4;
use donatj\MDDoc\Documentation;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;
use donatj\MDDoc\Exceptions\ConfigException;

class ConfigParser {

	/**
	 * @param array                           $attribute_tree
	 * @throws ConfigException
	 */
	private function loadChildren( \DOMElement $node, Documentation\AbstractNestedDoc &$parent, array $tree_extra = [], $attribute_tree = [] ) {

		if( $sel_loader = $node->getAttribute('autoloader') ) {
			switch( strtolower($sel_loader) ) {
				case 'psr0':
					$root                     = $this->requireAttr($node, 'autoloader-root');
					$tree_extra['autoloader'] = new Psr0($root);
					break;
				case 'psr4':
					$root_namespace           = $this->requireAttr($node, 'autoloader-root-namespace');
					$root                     = $this->requireAttr($node, 'autoloader-root');
					$tree_extra['autoloader'] = new Psr4($root_namespace, $root);
					break;
				default:
					throw new ConfigException("Unrecognized autoloader: {$sel_loader}");
			}
		} elseif( !isset($tree_extra['autoloader']) ) {
			$tree_extra['autoloader'] = new NullLoader();
		}

		foreach( $node->childNodes as $child ) {
			if( $child instanceof \DOMElement ) {

				$attributes           = $this->nodeAttr($child);
				$child_attribute_tree = array_merge($attribute_tree, $attributes);

				switch( strtolower($child->nodeName) ) {
					case 'section':
						$childDoc = new Documentation\Section($attributes, $child_attribute_tree);
						break;
					case 'docpage':
						$childDoc = new Documentation\DocPage($attributes, $child_attribute_tree);
						break;
					case 'text':
						$childDoc = new Documentation\Text($attributes, $child_attribute_tree, $child->textContent);
						break;
					case 'file':
						$childDoc = new Documentation\ClassFile($attributes, $child_attribute_tree);
						break;
					case 'recursivedirectory':
						$childDoc = new Documentation\RecursiveDirectory($attributes, $child_attribute_tree);
						break;
					case 'include':
						$childDoc = new Documentation\IncludeFile($attributes, $child_attribute_tree);
						break;
					case 'source':
						$childDoc = new Documentation\Source($attributes, $child_attribute_tree, $child->textContent);
						break;
					case 'composer-install':
						$childDoc = new Documentation\ComposerInstall($attributes, $child_attribute_tree);
						break;
					case 'composer-requires':
						$childDoc = new Documentation\ComposerRequires($attributes, $child_attribute_tree);
						break;
					case 'badge':
						$childDoc = new Documentation\Badges\Badge($attributes, $child_attribute_tree);
						break;
					case 'badge-poser':
						$childDoc = new Documentation\Badges\BadgePoser($attributes, $child_attribute_tree);
						break;
					case 'badge-travis':
						$childDoc = new Documentation\Badges\BadgeTravis($attributes, $child_attribute_tree);
						break;
					case 'badge-scrutinizer':
						$childDoc = new Documentation\Badges\BadgeScrutinizer($attributes, $child_attribute_tree);
						break;
					case 'badge-github-action':
						$childDoc = new Documentation\Badges\BadgeGitHubActions($attributes, $child_attribute_tree);
						break;
					case 'exec':
						$childDoc = new Documentation\ExecOutput($attributes, $child_attribute_tree);
						break;
					default:
						throw new ConfigException("Invalid XML Tag: {$child->nodeName}");
				}

				$parent->addChild($childDoc);
				$childDoc->setParent($parent);

				if( $childDoc instanceof AutoloaderAware && isset($tree_extra['autoloader']) ) {
					$childDoc->setAutoloader($tree_extra['autoloader']);
				}

				if( $child->hasChildNodes() && $childDoc instanceof Documentation\AbstractNestedDoc ) {
					$this->loadChildren($child, $childDoc, $tree_extra, $child_attribute_tree);
				}
			}
		}
	}

	/**
	 * @param  string     $attribute
	 * @return string
	 * @throws ConfigException
	 */
	private function requireAttr( \DOMElement $node, $attribute ) {
		if( !$value = $node->getAttribute($attribute) ) {
			throw new ConfigException("Element `{$node->nodeName}` missing required attribute: {$attribute}");
		}

		return $value;
	}

	private function nodeAttr( \DOMElement $node ) {
		$attributes = [];
		if( $node->hasAttributes() ) {
			foreach( $node->attributes as $attr ) {
				$attributes[strtolower($attr->nodeName)] = $attr->nodeValue;
			}
		}

		return $attributes;
	}

	/**
	 * Parse a config file
	 *
	 * @param string $filename
	 * @return \donatj\MDDoc\Documentation\DocRoot
	 * @throws \donatj\MDDoc\Exceptions\ConfigException
	 */
	public function parse( string $filename ) {
		if( !is_readable($filename) ) {
			throw new ConfigException("Config file '{$filename}' not readable");
		}

		$dom = new \DOMDocument();
		if( @$dom->load($filename) === false ) {
			throw new ConfigException("Error parsing {$filename}");
		}

		$root = $dom->firstChild;
		if( !$root instanceof \DOMElement ) {
			throw new \RuntimeException('Needs a DOM element');
		}

		$docRoot = new Documentation\DocRoot([], []);
		if( $root->nodeName == 'mddoc' ) {
			$this->loadChildren($root, $docRoot);
		} else {
			if( $root->nodeName ) {
				throw new ConfigException("XML Root element `{$root->nodeName}` is invalid.");
			}

			throw new ConfigException("Error parsing {$filename}");
		}

		return $docRoot;
	}

}
