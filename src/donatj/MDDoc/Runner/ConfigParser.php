<?php
namespace donatj\MDDoc\Runner;

use donatj\MDDoc\Documentation\AbstractNestedDoc;
use donatj\MDDoc\Documentation\DocPage;
use donatj\MDDoc\Documentation\DocRoot;
use donatj\MDDoc\Documentation\File;
use donatj\MDDoc\Documentation\RecursiveDirectory;
use donatj\MDDoc\Documentation\Section;
use donatj\MDDoc\Documentation\Text;
use donatj\MDDoc\Exceptions\ConfigException;

class ConfigParser {

	function __construct( $filename ) {

		$dom = new \DOMDocument();

		$dom->load($filename);

		$root = $dom->firstChild;

		$docRoot = new DocRoot();

		if( $root->nodeName == 'mddoc' ) {
			$this->loadChildren($root, $docRoot);
		} else {
			throw new ConfigException('Root element `{$root->nodeName}` is invalid.');
		}

		$docRoot->output();
	}

	private function requireAttribute( \DOMElement $node, $attribute ) {
		if( !$value = $node->getAttribute($attribute) ) {
			throw new ConfigException("Element `{$node->nodeName}` missing required attribute: {$attribute}");
		}

		return $value;
	}

	private function loadChildren( \DOMElement $node, AbstractNestedDoc &$parent ) {

		foreach( $node->childNodes as $child ) {
			if( $child instanceof \DOMElement ) {

				switch( strtolower($child->nodeName) ) {
					case 'section':
						$title = $this->requireAttribute($child, 'title');
						$childDoc = new Section($title);
						break;
					case 'docpage';
						$target = $this->requireAttribute($child, 'target');
						$childDoc = new DocPage($target);
						break;
					case 'text':
						$childDoc = new Text( $child->textContent );
						break;
					case 'file';
						$name = $this->requireAttribute($child, 'name');
						$childDoc = new File($name);
						break;
					case 'recursivedirectory':
						$name = $this->requireAttribute($child, 'name');
						$childDoc = new RecursiveDirectory($name);
						break;
					default:
						throw new ConfigException("Invalid XML Tag: " . $child->nodeName);
				}

				$parent->addChild($childDoc);

				/**
				 * @var $child \DOMNode
				 */

				if( $child->hasChildNodes() && $childDoc instanceof AbstractNestedDoc ) {
					$this->loadChildren($child, $childDoc);
				}


//				see($child->nodeName);
			}

		}

	}
}
