<?php

/**
 * Recursively search a directory for php files to generate documentation for
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;
use donatj\MDDom\Document;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class RecursiveDirectory extends AbstractNestedDoc implements AutoloaderAware, LoggerAwareInterface {

	use LoggerAwareTrait;

	/**
	 * The directory to recursively search for files to document
	 *
	 * @mddoc-required
	 */
	public const OPT_NAME = 'name';
	/** A regex to filter files by - specify files to be matched */
	public const OPT_FILE_FILTER = 'file-filter';

	private $autoloader;

	public function setAutoloader( AutoloaderInterface $autoloader ) : void {
		$this->autoloader = $autoloader;
	}

	public function output( int $depth ) : Document {
		$document = new Document;
		$name     = $this->getOption(self::OPT_NAME);

		foreach( $this->getFileList($name) as $file ) {
			if( $fileFilter = $this->getOption(self::OPT_FILE_FILTER) ) {
				if( !preg_match($fileFilter, (string)$file) ) {
					continue;
				}
			}

			$class = new PhpFileDocs(
				$this->getAttributeTree()->withAttr([ self::OPT_NAME => (string)$file ])
			);
			if( $this->logger ) {
				$class->setLogger($this->logger);
			}
			$this->addChildren($class);
		}

		foreach( $this->getDocumentationChildren() as $child ) {
			if( $child instanceof AutoloaderAware ) {
				$child->setAutoloader($this->autoloader);
			}

			$document->appendChild($child->output($depth));
		}

		return $document;
	}

	protected function init() : void {
		$this->requireOption(self::OPT_NAME);
	}

	private function getFileList( $path ) : iterable {
		if( $real = $this->getWorkingFilePath($path) ) {
			$path = $real;
		}

		$path = rtrim($path, DIRECTORY_SEPARATOR);

		if( is_dir($path) ) {
			$dir   = new \RecursiveDirectoryIterator($path);
			$ite   = new \RecursiveIteratorIterator($dir);
			$files = new \RegexIterator($ite, "/\\.php$/");

			$fileArray = iterator_to_array($files, false);
			usort($fileArray, function ( \SplFileInfo $a, \SplFileInfo $b ) {
				return strnatcasecmp($a->getRealPath(), $b->getRealPath());
			});

			return new \ArrayIterator($fileArray);
		}

		return new \ArrayIterator([ $path ]);
	}

	public static function tagName() : string {
		return 'recursive-directory';
	}

}
