<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use donatj\MDDoc\Exceptions\ClassNotReadableException;
use phpDocumentor\Reflection\ClassReflector;
use phpDocumentor\Reflection\ClassReflector\MethodReflector;
use phpDocumentor\Reflection\FileReflector;
use phpDocumentor\Reflection\InterfaceReflector;
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

		try {
			$fileReflector = new FileReflector($filename, true);
			$fileReflector->process();
			$fileReflector->scanForMarkers();
		} catch( \Exception $e ) {
			throw new ClassNotReadableException('Class not readable', $filename, $e);
		}

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

	private function registerReflectors( InterfaceReflector $reflector ) {

		if( !$this->reflector ) {
			$this->reflector = $reflector;
		}

		$loader = $this->autoLoader;

		/**
		 * @var $method MethodReflector
		 */
		$reflector->getName();
		foreach( $reflector->getMethods() as $method ) {
			$this->data['methods'][$method->getShortName()][] = $method;
		}

		foreach( $reflector->getConstants() as $constant ) {
			$this->data['constants'][$constant->getShortName()][] = $constant;
		}

		foreach( $reflector->getProperties() as $property ) {
			$this->data['properties'][$property->getShortName()][] = $property;
		}

		if( $reflector instanceof ClassReflector || $reflector instanceof TraitReflector ) {
			if( $parent = $reflector->getParentClass() ) {
				$filename = $loader($parent);
				if( is_readable($filename) ) {
					$parser     = $this->parserFactory->newInstance($filename, $loader);
					$this->data = array_merge_recursive($this->data, $parser->getData());
				}
			}

			if( $traits = $reflector->getTraits() ) {
				foreach( $traits as $trait ) {
					$filename = $loader($trait);
					if( is_readable($filename) ) {
						$parser     = $this->parserFactory->newInstance($filename, $loader);
						$this->data = array_merge_recursive($this->data, $parser->getData());
					}
				}
			}
		}

		if( $reflector instanceof InterfaceReflector ) {
			foreach( $reflector->getParentInterfaces() as $interface ) {
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
	 * @return InterfaceReflector|null
	 */
	public function getReflector() {
		return $this->reflector;
	}

	/**
	 * @return \phpDocumentor\Reflection\ClassReflector\MethodReflector[][]
	 */
	public function getMethods() {
		return $this->data['methods'] ?? [];
	}

	/**
	 * @return \phpDocumentor\Reflection\ClassReflector\ConstantReflector[][]
	 */
	public function getConstants() {
		return $this->data['constants'] ?? [];
	}

	/**
	 * @return \phpDocumentor\Reflection\ClassReflector\PropertyReflector[][]
	 */
	public function getProperties() {
		return $this->data['properties'] ?? [];
	}
}
