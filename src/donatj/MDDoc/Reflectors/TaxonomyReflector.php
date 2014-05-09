<?php

namespace donatj\MDDoc\Reflectors;

use donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface;
use phpDocumentor\Reflection\ClassReflector\MethodReflector;
use phpDocumentor\Reflection\ClassReflector;
use phpDocumentor\Reflection\FileReflector;
use phpDocumentor\Reflection\InterfaceReflector;

class TaxonomyReflector {

	private $fileReflector;
	private $fileName;
	/**
	 * @var callable
	 */
	private $autoLoader;
	private $data;
	private $parserFactory;
	private $reflector = null;

	/**
	 * @param string                   $filename
	 * @param AutoloaderInterface      $autoLoader
	 * @param TaxonomyReflectorFactory $parserFactory
	 */
	public function __construct( $filename, AutoloaderInterface $autoLoader, TaxonomyReflectorFactory $parserFactory ) {
		$this->fileName      = $filename;
		$this->autoLoader    = $autoLoader;
		$this->parserFactory = $parserFactory;
		$this->data          = array();

		$this->fileReflector = new FileReflector($filename);
		$this->fileReflector->process();
		$this->fileReflector->scanForMarkers();

		foreach( $this->fileReflector->getInterfaces() as $interfaces ) {
			$this->registerReflectors($interfaces);
		}

		foreach( $this->fileReflector->getClasses() as $interfaces ) {
			$this->registerReflectors($interfaces);
		}

		$this->fileReflector->getClasses();
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

		if( $reflector instanceof ClassReflector ) {
			if( $parent = $reflector->getParentClass() ) {
				$filename = $loader($parent);
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

	/**
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @return null|InterfaceReflector
	 */
	public function getReflector() {
		return $this->reflector;
	}

	/**
	 * @return \phpDocumentor\Reflection\ClassReflector\MethodReflector[][]
	 */
	public function getMethods() {
		return isset($this->data['methods']) ? $this->data['methods'] : array();
	}

}