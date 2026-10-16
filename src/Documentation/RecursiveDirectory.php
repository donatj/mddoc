<?php

/**
 * Recursively search a directory for php files to generate documentation for
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Documentation\Interfaces\AutoloaderAware;
use donatj\MDDom\Document;
use donatj\MDDom\DocumentDepth;
use donatj\MDDom\Header;
use donatj\MDDom\Text as MdText;
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

	private const TABLE_OF_CONTENTS = 'table-of-contents';

	private AutoloaderInterface $autoloader;

	public function setAutoloader( AutoloaderInterface $autoloader ) : void {
		$this->autoloader = $autoloader;
	}

	public function output( int $depth ) : Document {
		$document = new Document;
		$name     = $this->requireOption(self::OPT_NAME);

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

		$outputs         = [];
		$tableOfContents = [];
		foreach( $this->getDocumentationChildren() as $child ) {
			if( $child instanceof AutoloaderAware ) {
				$child->setAutoloader($this->autoloader);
			}

			$output = $child->output($depth);
			if( $output === '' ) {
				continue;
			}

			$outputs[] = $output;

			if( $child instanceof PhpFileDocs && ($entry = $child->getTableOfContents()) !== null ) {
				$tableOfContents[] = $entry;
			}
	}

		if( $this->hasTableOfContents() && $tableOfContents ) {
			$tableDocument = new DocumentDepth;
			$tableDocument->appendChild(new Header('Table of Contents'));
			$tableDocument->appendChild(new MdText($this->tableOfContentsMarkdown($tableOfContents)));
			$document->appendChild($tableDocument);
		}

		foreach( $outputs as $output ) {
			$document->appendChild($output);
		}

		return $document;
	}

	private function hasTableOfContents() : bool {
		return strtolower($this->getOption(self::TABLE_OF_CONTENTS, true) ?? 'false') === 'true';
	}

	/**
	 * @param list<array{type:string,name:string,anchor:string,methods:list<array{type:string,name:string,anchor:string}>}> $entries
	 */
	private function tableOfContentsMarkdown( array $entries ) : string {
		$output = '';
		foreach( $entries as $entry ) {
			$output .= sprintf("- [%s %s](#%s)\n", strtolower($entry['type']), $entry['name'], $entry['anchor']);

			foreach( $entry['methods'] as $method ) {
				$output .= sprintf("    - [function %s](#%s)\n", $method['name'], $method['anchor']);
			}
		}

		return rtrim($output);
	}

	protected function init() : void {
		$this->requireOption(self::OPT_NAME);
	}

	/**
	 * @return iterable<\SplFileInfo>
	 */
	private function getFileList( string $path ) : iterable {
		if( $real = $this->getWorkingFilePath($path) ) {
			$path = $real;
		}

		$path = rtrim($path, DIRECTORY_SEPARATOR);

		if( is_dir($path) ) {
			$dir = new \RecursiveDirectoryIterator($path);
			$ite = new \RecursiveIteratorIterator($dir);
			/** @var \Traversable<\SplFileInfo> $files */
			$files = new \RegexIterator($ite, "/\\.php$/");

			$fileArray = iterator_to_array($files, false);
			usort($fileArray, function ( \SplFileInfo $a, \SplFileInfo $b ) : int {
				return strnatcasecmp($a->getRealPath(), $b->getRealPath());
			});

			return new \ArrayIterator($fileArray);
		}

		return new \ArrayIterator([
			new \SplFileInfo($path),
		]);
	}

	public static function tagName() : string {
		return 'recursive-directory';
	}

}
