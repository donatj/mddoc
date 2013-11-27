<?php

namespace donatj\MDDoc;

use phpDocumentor\Reflection\ClassReflector;
use phpDocumentor\Reflection\ClassReflector\MethodReflector;
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

	/**
	 * @param string              $filename
	 * @param callable            $autoLoader
	 * @param TaxonomyReflectorFactory $parserFactory
	 */
	public function __construct( $filename, callable $autoLoader, TaxonomyReflectorFactory $parserFactory ) {
		$this->fileName      = $filename;
		$this->autoLoader    = $autoLoader;
		$this->parserFactory = $parserFactory;

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

		$loader = $this->autoLoader;

		/**
		 * @var $method MethodReflector
		 */
		$reflector->getName();
		foreach( $reflector->getMethods() as $method ) {
			$this->data['methods'][$method->getShortName()][] = $this->fileName;
		}

		if( $reflector instanceof ClassReflector ) {
			if( $parent = $reflector->getParentClass() ) {
				$parser     = $this->parserFactory->newInstance($loader($parent), $loader);
				$parserData = $parser->getData();
				$this->data = array_merge_recursive( $this->data, $parserData );
//				$this->mergeIntoData($parserData, $reflector);
			}
		}

		if( method_exists($reflector, 'getInterfaces') ) {
			foreach( $reflector->getInterfaces() as $interface ) {
				$parser     = $this->parserFactory->newInstance($loader($interface), $loader);
				$parserData = $parser->getData();
				$this->data = array_merge_recursive( $this->data, $parserData );
//				$this->mergeIntoData($parserData, $reflector);
			}
		}

	}

	/**
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}

	public function getMethods() {
		return $this->data['methods'];
	}


}