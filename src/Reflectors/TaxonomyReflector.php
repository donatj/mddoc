<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Exceptions\ClassNotReadableException;
use phpDocumentor\Reflection\Element;
use phpDocumentor\Reflection\File\LocalFile;
use phpDocumentor\Reflection\Php\Class_;
use phpDocumentor\Reflection\Php\Interface_;
use phpDocumentor\Reflection\Php\ProjectFactory;
use phpDocumentor\Reflection\Php\Trait_;

class TaxonomyReflector {

	/** @var callable */
	private $autoLoader;
	private $data;
	private $parserFactory;
	private $reflector;

	/**
	 * @throws ClassNotReadableException
	 */
	public function __construct( string $filename, AutoloaderInterface $autoLoader, TaxonomyReflectorFactory $parserFactory ) {
		$this->autoLoader    = $autoLoader;
		$this->parserFactory = $parserFactory;
		$this->data          = [];

		$projectFiles = [ new LocalFile($filename) ];

		try {
			$project = (ProjectFactory::createInstance())->create('My Project', $projectFiles);
		} catch( \Exception $ex ) {
			throw new ClassNotReadableException("failed to read class file", $filename, $ex);
		}

		/** @var \phpDocumentor\Reflection\Php\File $fileReflector */
		$fileReflector = $project->getFiles()[$filename];

		foreach( $fileReflector->getInterfaces() as $interfaces ) {
			$this->registerReflectors($interfaces);
		}

		foreach( $fileReflector->getClasses() as $class ) {
			$this->registerReflectors($class);
		}

		foreach( $fileReflector->getTraits() as $trait ) {
			$this->registerReflectors($trait);
		}

		//		$this->fileReflector->getClasses(); // -- I don't think this did anything.
	}

	/**
	 * @param Class_|Interface_|Trait_ $reflector
	 */
	private function registerReflectors( $reflector ) : void {

		if( !$this->reflector ) {
			$this->reflector = $reflector;
		}

		$loader = $this->autoLoader;

		foreach( $reflector->getMethods() as $method ) {
			$this->data['methods'][$method->getName()][] = $method;
		}

		foreach( $reflector->getConstants() as $constant ) {
			$this->data['constants'][$constant->getName()][] = $constant;
		}

		if( method_exists($reflector, 'getProperties') ) {
			foreach( $reflector->getProperties() as $property ) {
				$this->data['properties'][$property->getName()][] = $property;
			}
		}

		if( $reflector instanceof Class_ || $reflector instanceof Trait_ ) {
			if( $parent = $reflector->getParent() ) {
				$filename = $loader($parent);
				if( is_readable($filename) ) {
					$parser     = $this->parserFactory->newInstance($filename, $loader);
					$this->data = array_merge_recursive($this->data, $parser->data);
				}
			}

			if( $traits = $reflector->getUsedTraits() ) {
				foreach( $traits as $trait ) {
					$filename = $loader($trait);
					if( is_readable($filename) ) {
						$parser     = $this->parserFactory->newInstance($filename, $loader);
						$this->data = array_merge_recursive($this->data, $parser->data);
					}
				}
			}
		}

		if( $reflector instanceof Interface_ ) {
			foreach( $reflector->getParents() as $interface ) {
				$filename = $loader($interface);
				if( is_readable($filename) ) {
					$parser     = $this->parserFactory->newInstance($filename, $loader);
					$this->data = array_merge_recursive($this->data, $parser->data);
				}
			}
		}

		if( method_exists($reflector, 'getInterfaces') ) {
			foreach( $reflector->getInterfaces() as $interface ) {
				$filename = $loader($interface);
				if( is_readable($filename) ) {
					$parser     = $this->parserFactory->newInstance($filename, $loader);
					$this->data = array_merge_recursive($this->data, $parser->data);
				}
			}
		}
	}

	/**
	 * @return Class_|Interface_|Trait_|null
	 */
	public function getReflector() : Element {
		return $this->reflector;
	}

	/**
	 * @return \phpDocumentor\Reflection\Php\Method[][]
	 */
	public function getMethods() : array {
		return $this->data['methods'] ?? [];
	}

	/**
	 * @return \phpDocumentor\Reflection\Php\Constant[][]
	 */
	public function getConstants() : array {
		return $this->data['constants'] ?? [];
	}

	/**
	 * @return \phpDocumentor\Reflection\Php\Property[][]
	 */
	public function getProperties() : array {
		return $this->data['properties'] ?? [];
	}

}
