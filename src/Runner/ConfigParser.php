<?php

namespace donatj\MDDoc\Runner;

use donatj\MDDoc\Autoloaders\NullLoader;
use donatj\MDDoc\Autoloaders\Psr0;
use donatj\MDDoc\Autoloaders\Psr4;
use donatj\MDDoc\Documentation;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;
use donatj\MDDoc\DocumentationFactory;
use donatj\MDDoc\Exceptions\ConfigException;

class ConfigParser {

	/** @var \donatj\MDDoc\DocumentationFactory */
	private $documentationFactory;

	public function __construct( DocumentationFactory $documentationFactory ) {
		$this->documentationFactory = $documentationFactory;
	}

	/**
	 * @throws \donatj\MDDoc\Exceptions\ConfigException
	 */
	private function loadChildren(
		\DOMElement $node,
		Documentation\AbstractNestedDoc $parent,
		ImmutableAttributeTree $newAttributeTree,
		array $treeExtra = []
	) : void {
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
			if( $child instanceof \DOMElement ) {
				$attributes = $this->nodeAttr($child);

				$newAttributes = $newAttributeTree->withAttr($attributes);

				$childDoc = $this->documentationFactory->makeFromTag(
					$child->nodeName, $newAttributes, $child->textContent
				);

				$parent->addChildren($childDoc);
				$childDoc->setParent($parent);

				if( $childDoc instanceof AutoloaderAware && isset($treeExtra['autoloader']) ) {
					$childDoc->setAutoloader($treeExtra['autoloader']);
				}

				if( $childDoc instanceof Documentation\AbstractNestedDoc && $child->hasChildNodes() ) {
					$this->loadChildren($child, $childDoc, $newAttributes, $treeExtra);
				}
			}
		}
	}

	/**
	 * @throws ConfigException
	 */
	private function requireAttr( \DOMElement $node, string $attribute ) : string {
		if( !$value = $node->getAttribute($attribute) ) {
			throw new ConfigException("Element `{$node->nodeName}` missing required attribute: {$attribute}");
		}

		return $value;
	}

	private function nodeAttr( \DOMElement $node ) : array {
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
	 * @throws \donatj\MDDoc\Exceptions\ConfigException
	 * @return \donatj\MDDoc\Documentation\DocRoot
	 */
	public function parse( string $filename ) : Documentation\DocRoot {
		if( !is_readable($filename) ) {
			throw new ConfigException("Config file '{$filename}' not readable");
		}

		libxml_use_internal_errors(true);
		$dom = new \DOMDocument;
		if( @$dom->load($filename) === false ) {
			$error = libxml_get_last_error();
			if( $error ) {
				throw new ConfigException("Unknown error parsing {$filename} - {$error->message}");
			}

			throw new ConfigException("Unknown error parsing {$filename}");
		}

		$root = $dom->firstChild;
		if( !$root instanceof \DOMElement ) {
			throw new \RuntimeException('Needs a DOM element');
		}

		$attributeTree = (new ImmutableAttributeTree)->withAttr($this->nodeAttr($root));

		$docRoot = new Documentation\DocRoot($attributeTree);
		if( $root->nodeName === 'mddoc' ) {
			$this->loadChildren($root, $docRoot, $attributeTree);
		} else {
			if( $root->nodeName ) {
				throw new ConfigException("XML Root element `{$root->nodeName}` is invalid. Expected mddoc.");
			}

			throw new ConfigException("Error parsing {$filename}");
		}

		return $docRoot;
	}

}
