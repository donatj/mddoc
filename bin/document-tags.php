#!/usr/bin/env php
<?php

use donatj\MDDoc\Documentation\AbstractNestedDoc;
use donatj\MDDoc\Documentation\Interfaces\DocumentationInterface;
use donatj\MDDoc\Documentation\Interfaces\ElementInterface;
use donatj\MDDoc\ElementFactory;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDom\Code;
use donatj\MDDom\Document;
use donatj\MDDom\DocumentDepth;
use donatj\MDDom\Header;
use donatj\MDDom\Paragraph;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\File\LocalFile;
use phpDocumentor\Reflection\Php\ProjectFactory;

require __DIR__ . '/../vendor/autoload.php';

$doc = new Document;

foreach( ElementFactory::DEFAULT_ELEMENTS as $documentor ) {
	$reflector = new ReflectionClass($documentor);
	$filename  = $reflector->getFileName();

	$project = (ProjectFactory::createInstance())->create('My Project', [ new LocalFile($filename) ]);
	$file    = $project->getFiles()[$filename];


	if( !is_subclass_of($documentor, ElementInterface::class) ) {
		throw new ConfigException("{$documentor} does not implement " . ElementInterface::class);
	}

	$isNesting = is_subclass_of($documentor, AbstractNestedDoc::class);

	$tagName    = $documentor::tagName();
	$headerText = '<' . $tagName . ($isNesting ? '>…</' . $tagName . '>' : ' />');

	$doc->appendChild(new Header(new Code($headerText)));

	$block = $file->getDocBlock();
	if( $block ) {
		$doc->appendChild(new Paragraph(getDocStr($block)));
	}

	$classes = $file->getClasses();
	foreach( $classes as $class ) {
		$constants = $class->getConstants();
		if( $constants ) {
			$constantDoc = new DocumentDepth(new Header('Attributes:'));
			$doc->appendChild($constantDoc);

			$attributes = '';
			foreach( $constants as $constant ) {
				if( strpos($constant->getName(), 'OPT_') !== 0 ) {
					continue;
				}

				$constantDocText = '';

				$constantBlock = $constant->getDocBlock();
				if( $constantBlock ) {
					$constantDocText = getDocStr($constantBlock);
				}

				$attributes .= "- `" . trim($constant->getValue(), "'") . "`";

				if( $constantBlock && $constantBlock->getTagsByName('mddoc-recurse') ) {
					$attributes .= ' _[recursive]_';
				}

				if( $constantBlock && $constantBlock->getTagsByName('mddoc-required') ) {
					$attributes .= ' **(required)**';
				}

				if( $constantDocText ) {
					$attributes .= " - {$constantDocText}";
				}

				$attributes .= "\n";
			}

			$constantDoc->appendChild(new Paragraph($attributes));
		}
	}
}


echo $doc->exportMarkdown(2);

// @todo deduplicate;
function getDocStr( DocBlock $block ) : string {
	return trim(
		trim($block->getSummary()) .
		"\n\n" .
		trim($block->getDescription()->__toString())
	);
}
