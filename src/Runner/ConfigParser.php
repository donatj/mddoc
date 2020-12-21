<?php

namespace donatj\MDDoc\Runner;

use DOMDocument;
use DOMElement;
use donatj\MDDoc\Autoloaders\NullLoader;
use donatj\MDDoc\Autoloaders\Psr0;
use donatj\MDDoc\Autoloaders\Psr4;
use donatj\MDDoc\Documentation;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;
use donatj\MDDoc\Exceptions\ConfigException;
use RuntimeException;

class ConfigParser {

	/**
	 * @var \donatj\MDDoc\Documentation\DocumentationFactory
	 */
	private $documentationFactory;

	public function __construct( ?Documentation\DocumentationFactory $documentationFactory = null ) {
		$this->documentationFactory = $documentationFactory ?? new Documentation\DocumentationFactory;
	}

	/**
	 * @param array $attributeTree
	 * @throws ConfigException
	 */
	private function loadChildren( DOMElement $node, Documentation\AbstractNestedDoc $parent, array $treeExtra = [], $attributeTree = [], ?ImmutableAttributeTree $newAttributeTree = null ) : void {
		$newAttributeTree = $newAttributeTree ?? new ImmutableAttributeTree;

		if( $sel_loader = $node->getAttribute('autoloader') ) {
			switch( strtolower($sel_loader) ) {
				case 'psr0':
					$root                    = $this->requireAttr($node, 'autoloader-root');
					$treeExtra['autoloader'] = new Psr0($root);
					break;
				case 'psr4':
					$root_namespace          = $this->requireAttr($node, 'autoloader-root-namespace');
					$root                    = $this->requireAttr($node, 'autoloader-root');
					$treeExtra['autoloader'] = new Psr4($root_namespace, $root);
					break;
				default:
					throw new ConfigException("Unrecognized autoloader: {$sel_loader}");
			}
		} elseif( !isset($treeExtra['autoloader']) ) {
			$treeExtra['autoloader'] = new NullLoader;
		}

		foreach( $node->childNodes as $child ) {
			if( $child instanceof DOMElement ) {
				$attributes = $this->nodeAttr($child);

				$newAttributes      = $newAttributeTree->withAttr($child->tagName, $attributes);
				$childAttributeTree = array_merge($attributeTree, $attributes);

				$childDoc = $this->documentationFactory->makeFromTag(
					$child->nodeName, $newAttributes, $attributes, $childAttributeTree, $child->textContent
				);

				$parent->addChild($childDoc);
				$childDoc->setParent($parent);

				if( $childDoc instanceof AutoloaderAware && isset($treeExtra['autoloader']) ) {
					$childDoc->setAutoloader($treeExtra['autoloader']);
				}

				if( $child->hasChildNodes() && $childDoc instanceof Documentation\AbstractNestedDoc ) {
					$this->loadChildren($child, $childDoc, $treeExtra, $childAttributeTree, $newAttributes);
				}
			}
		}
	}

	/**
	 * @throws ConfigException
	 */
	private function requireAttr( DOMElement $node, string $attribute ) : string {
		if( !$value = $node->getAttribute($attribute) ) {
			throw new ConfigException("Element `{$node->nodeName}` missing required attribute: {$attribute}");
		}

		return $value;
	}

	private function nodeAttr( DOMElement $node ) : array {
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
	 * @return \donatj\MDDoc\Documentation\DocRoot
	 * @throws \donatj\MDDoc\Exceptions\ConfigException
	 */
	public function parse( string $filename ) : Documentation\DocRoot {
		if( !is_readable($filename) ) {
			throw new ConfigException("Config file '{$filename}' not readable");
		}

		$dom = new DOMDocument;
		if( @$dom->load($filename) === false ) {
			throw new ConfigException("Error parsing {$filename}");
		}

		$root = $dom->firstChild;
		if( !$root instanceof DOMElement ) {
			throw new RuntimeException('Needs a DOM element');
		}

		$docRoot = new Documentation\DocRoot(new ImmutableAttributeTree);
		if( $root->nodeName === 'mddoc' ) {
			$this->loadChildren($root, $docRoot);
		} else {
			if( $root->nodeName ) {
				throw new ConfigException("XML Root element `{$root->nodeName}` is invalid. Expected mddoc.");
			}

			throw new ConfigException("Error parsing {$filename}");
		}

		return $docRoot;
	}

}
