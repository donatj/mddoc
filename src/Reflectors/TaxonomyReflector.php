<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Exceptions\ClassNotReadableException;
use phpDocumentor\Reflection\ClassReflector;
use phpDocumentor\Reflection\ClassReflector\MethodReflector;
use phpDocumentor\Reflection\FileReflector;
use phpDocumentor\Reflection\InterfaceReflector;
use phpDocumentor\Reflection\Php\Class_;
use phpDocumentor\Reflection\Php\Interface_;
use phpDocumentor\Reflection\Php\ProjectFactory;
use phpDocumentor\Reflection\Php\Trait_;
use phpDocumentor\Reflection\TraitReflector;

class TaxonomyReflector {

	/**
	 * @var callable
	 */
	private $autoLoader;
	private $data;
	private $parserFactory;
	private $reflector = null;

	/**
	 * @throws ClassNotReadableException
	 */
	public function __construct( string $filename, AutoloaderInterface $autoLoader, TaxonomyReflectorFactory $parserFactory ) {
		$this->autoLoader    = $autoLoader;
		$this->parserFactory = $parserFactory;
		$this->data          = [];

		$projectFiles = [ new \phpDocumentor\Reflection\File\LocalFile($filename) ];
		$project      = (ProjectFactory::createInstance())->create('My Project', $projectFiles);
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
	private function registerReflectors( $reflector ) {

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
					$this->data = array_merge_recursive($this->data, $parser->getData());
				}
			}

			if( $traits = $reflector->getUsedTraits() ) {
				foreach( $traits as $trait ) {
					$filename = $loader($trait);
					if( is_readable($filename) ) {
						$parser     = $this->parserFactory->newInstance($filename, $loader);
						$this->data = array_merge_recursive($this->data, $parser->getData());
					}
				}
			}
		}

		if( $reflector instanceof Interface_ ) {
			foreach( $reflector->getParents() as $interface ) {
				$filename = $loader($interface);
				if( is_readable($filename) ) {
					$parser     = $this->parserFactory->newInstance($filename, $loader);
					$this->data = array_merge_recursive($this->data, $parser->getData());
				}
			}
		}

		if( method_exists($reflector, 'getInterfaces') ) {
			foreach( $reflector->getInterfaces() as $interface ) {
				$filename = $loader($interface);
				if( is_readable($filename) ) {
					$parser     = $this->parserFactory->newInstance($filename, $loader);
					$this->data = array_merge_recursive($this->data, $parser->getData());
				}
			}
		}
	}

	public function getData() {
		return $this->data;
	}

	/**
	 * @return Interface_|null
	 */
	public function getReflector() {
		return $this->reflector;
	}

	/**
	 * @return \phpDocumentor\Reflection\Php\Method[][]
	 */
	public function getMethods() {
		return $this->data['methods'] ?? [];
	}

	/**
	 * @return \phpDocumentor\Reflection\Php\Constant[][]
	 */
	public function getConstants() {
		return $this->data['constants'] ?? [];
	}

	/**
	 * @return \PhpParser\Builder\Property[][]
	 */
	public function getProperties() {
		return $this->data['properties'] ?? [];
	}
}
