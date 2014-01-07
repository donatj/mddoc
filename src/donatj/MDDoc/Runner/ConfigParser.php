<?php
namespace donatj\MDDoc\Runner;

use donatj\MDDoc\Autoloaders\Psr0;
use donatj\MDDoc\Documentation\AbstractNestedDoc;
use donatj\MDDoc\Documentation\DocPage;
use donatj\MDDoc\Documentation\DocRoot;
use donatj\MDDoc\Documentation\File;
use donatj\MDDoc\Documentation\IncludeFile;
use donatj\MDDoc\Documentation\IncludeSource;
use donatj\MDDoc\Documentation\RecursiveDirectory;
use donatj\MDDoc\Documentation\Section;
use donatj\MDDoc\Documentation\Text;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDoc\Interfaces\AutoloaderAware;

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

	private function loadChildren( \DOMElement $node, AbstractNestedDoc &$parent, array $tree_extra = array() ) {

		if( $sel_loader = $node->getAttribute('autoloader') ) {
			switch( strtolower($sel_loader) ) {
				case 'psr0':
					$root                     = $this->requireAttribute($node, 'autoloader-root');
					$tree_extra['autoloader'] = Psr0::makeAutoloader($root);
					break;
				default:
					throw new ConfigException("Unrecognized autoloader: {$sel_loader}");
			}
		}

		foreach( $node->childNodes as $child ) {
			if( $child instanceof \DOMElement ) {

				switch( strtolower($child->nodeName) ) {
					case 'section':
						$title    = $this->requireAttribute($child, 'title');
						$childDoc = new Section($title);
						break;
					case 'docpage';
						$target   = $this->requireAttribute($child, 'target');
						$childDoc = new DocPage($target);
						break;
					case 'text':
						$childDoc = new Text($child->textContent);
						break;
					case 'file';
						$name     = $this->requireAttribute($child, 'name');
						$childDoc = new File($name);
						break;
					case 'recursivedirectory':
						$name     = $this->requireAttribute($child, 'name');
						$childDoc = new RecursiveDirectory($name);
						break;
					case 'include':
						$name     = $this->requireAttribute($child, 'name');
						$childDoc = new IncludeFile($name);
						break;
					case 'source':
						$name     = $this->requireAttribute($child, 'name');
						$language = $child->getAttribute('lang') ?: null;
						$childDoc = new IncludeSource($name, $language);
						break;
					default:
						throw new ConfigException("Invalid XML Tag: {$child->nodeName}");
				}

				$parent->addChild($childDoc);

				if( $childDoc instanceof AutoloaderAware && isset($tree_extra['autoloader']) ) {
					$childDoc->setAutoloader($tree_extra['autoloader']);
				}

				if( $child->hasChildNodes() && $childDoc instanceof AbstractNestedDoc ) {
					$this->loadChildren($child, $childDoc, $tree_extra);
				}

			}

		}

	}

	private function requireAttribute( \DOMElement $node, $attribute ) {
		if( !$value = $node->getAttribute($attribute) ) {
			throw new ConfigException("Element `{$node->nodeName}` missing required attribute: {$attribute}");
		}

		return $value;
	}
}
