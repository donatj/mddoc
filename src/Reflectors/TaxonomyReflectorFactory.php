<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Reflectors\Source\ClassDefinition;

class TaxonomyReflectorFactory {

	/** @var array<string,TaxonomyReflector> */
	private $parsers = [];

	/**
	 * @throws \donatj\MDDoc\Exceptions\ClassNotReadableException
	 */
	public function newInstance( string $filename, AutoloaderInterface $autoLoader ) : TaxonomyReflector {
		$parsers = $this->collectParsers($filename, $autoLoader);
		$classes = $this->collectClasses($parsers);
		$definitions = $parsers[$filename]->resolveClassDefinitions($classes);

		return $parsers[$filename]->withResolvedDefinitions($definitions);
	}

	/**
	 * @return array<string,TaxonomyReflector>
	 */
	private function collectParsers( string $filename, AutoloaderInterface $autoLoader ) : array {
		$parsers = [];
		$filenames = [ $filename ];

		while( $filenames !== [] ) {
			$currentFilename = array_pop($filenames);
			if( isset($parsers[$currentFilename]) ) {
				continue;
			}

			$parser = $this->parserForFile($currentFilename, $autoLoader);
			$parsers[$currentFilename] = $parser;

			foreach( $parser->getDependencyNames() as $dependencyName ) {
				$dependencyFilename = ($autoLoader)($dependencyName);
				if( $dependencyFilename !== null && is_readable($dependencyFilename) ) {
					$filenames[] = $dependencyFilename;
				}
			}
		}

		return $parsers;
	}

	private function parserForFile( string $filename, AutoloaderInterface $autoLoader ) : TaxonomyReflector {
		if( !isset($this->parsers[$filename]) ) {
			$this->parsers[$filename] = new TaxonomyReflector($filename, $autoLoader, $this);
		}

		return $this->parsers[$filename];
	}

	/**
	 * @param array<string,TaxonomyReflector> $parsers
	 * @return array<string,ClassDefinition>
	 */
	private function collectClasses( array $parsers ) : array {
		$classes = [];
		foreach( $parsers as $parser ) {
			foreach( $parser->getClasses() as $class ) {
				$classes[$class->getReflector()->getFqsen()] = $class;
			}
		}

		return $classes;
	}

}
