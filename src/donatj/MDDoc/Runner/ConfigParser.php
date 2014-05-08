<?php
namespace donatj\MDDoc\Runner;

use donatj\MDDoc\Autoloaders\Psr0;
use donatj\MDDoc\Documentation\AbstractNestedDoc;
use donatj\MDDoc\Documentation\ClassFile;
use donatj\MDDoc\Documentation\DocPage;
use donatj\MDDoc\Documentation\DocRoot;
use donatj\MDDoc\Documentation\IncludeFile;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;
use donatj\MDDoc\Documentation\RecursiveDirectory;
use donatj\MDDoc\Documentation\Section;
use donatj\MDDoc\Documentation\Source;
use donatj\MDDoc\Documentation\Text;
use donatj\MDDoc\Exceptions\ConfigException;

class ConfigParser {

	function __construct( $filename ) {

		if( !is_readable($filename) ) {
			throw new ConfigException("Config file '{$filename}' not readable");
		}

		$dom = new \DOMDocument();
		$dom->load($filename);

		$root = $dom->firstChild;

		$docRoot = new DocRoot(array(), array());

		if( $root->nodeName == 'mddoc' ) {
			$this->loadChildren($root, $docRoot);
		} else {
			if( $root->nodeName ) {
				throw new ConfigException("XML Root element `{$root->nodeName}` is invalid.");
			} else {
				throw new ConfigException("Error parsing {$filename}");
			}
		}

		$docRoot->output();
	}

	private function loadChildren( \DOMElement $node, AbstractNestedDoc &$parent, array $tree_extra = array(), $attribute_tree = array() ) {

		if( $sel_loader = $node->getAttribute('autoloader') ) {
			switch( strtolower($sel_loader) ) {
				case 'psr0':
					$root                     = $this->requireAttr($node, 'autoloader-root');
					$tree_extra['autoloader'] = Psr0::makeAutoloader($root);
					break;
				default:
					throw new ConfigException("Unrecognized autoloader: {$sel_loader}");
			}
		}

		foreach( $node->childNodes as $child ) {
			if( $child instanceof \DOMElement ) {

				$attributes           = $this->nodeAttr($child);
				$child_attribute_tree = array_merge($attribute_tree, $attributes);

				switch( strtolower($child->nodeName) ) {
					case 'section':
						$childDoc = new Section($attributes, $child_attribute_tree);
						break;
					case 'docpage';
						$childDoc = new DocPage($attributes, $child_attribute_tree);
						break;
					case 'text':
						$childDoc = new Text($attributes, $child_attribute_tree, $child->textContent);
						break;
					case 'file';
						$childDoc = new ClassFile($attributes, $child_attribute_tree);
						break;
					case 'recursivedirectory':
						$childDoc = new RecursiveDirectory($attributes, $child_attribute_tree);
						break;
					case 'include':
						$childDoc = new IncludeFile($attributes, $child_attribute_tree);
						break;
					case 'source':
						$childDoc = new Source($attributes, $child_attribute_tree, $child->textContent);
						break;
					default:
						throw new ConfigException("Invalid XML Tag: {$child->nodeName}");
				}

				$parent->addChild($childDoc);

				if( $childDoc instanceof AutoloaderAware && isset($tree_extra['autoloader']) ) {
					$childDoc->setAutoloader($tree_extra['autoloader']);
				}

				if( $child->hasChildNodes() && $childDoc instanceof AbstractNestedDoc ) {
					$this->loadChildren($child, $childDoc, $tree_extra, $child_attribute_tree);
				}

			}

		}

	}

	private function requireAttr( \DOMElement $node, $attribute ) {
		if( !$value = $node->getAttribute($attribute) ) {
			throw new ConfigException("Element `{$node->nodeName}` missing required attribute: {$attribute}");
		}

		return $value;
	}

	private function nodeAttr( \DOMElement $node ) {
		$attributes = array();
		if( $node->hasAttributes() ) {
			foreach( $node->attributes as $attr ) {
				$attributes[strtolower($attr->nodeName)] = $attr->nodeValue;
			}
		}

		return $attributes;
	}

	private function optionalAttr( \DOMElement $node, $attribute ) {
		return $node->getAttribute($attribute) ? : null;
	}
}
