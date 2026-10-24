<?php

namespace donatj\MDDoc\Reflectors\Source;

/** @mddoc-ignore */
class ClassDefinition {

	private Element $reflector;

	/**
	 * @var array{
	 *     docMethods:array<string,list<Tag>>,
	 *     methods:array<string,list<Element>>,
	 *     constants:array<string,list<Element>>,
	 *     properties:array<string,list<Element>>
	 * }
	 */
	private array $data = [
		'docMethods' => [],
		'methods'    => [],
		'constants'  => [],
		'properties' => [],
	];

	/** @var list<string> */
	private array $dependencies = [];

	public function __construct( Element $reflector ) {
		$this->reflector = $reflector;
	}

	public function getReflector() : Element {
		return $this->reflector;
	}

	public function addDocMethod( Tag $method ) : void {
		$this->data['docMethods'][$method->getMethodName()][] = $method;
	}

	public function addMethod( Element $method ) : void {
		$this->data['methods'][$method->getName()][] = $method;
	}

	public function addConstant( Element $constant ) : void {
		$this->data['constants'][$constant->getName()][] = $constant;
	}

	public function addProperty( Element $property ) : void {
		$this->data['properties'][$property->getName()][] = $property;
	}

	public function addDependency( string $dependency ) : void {
		$this->dependencies[] = $dependency;
	}

	/** @return list<string> */
	public function getDependencies() : array {
		return $this->dependencies;
	}

	public function mergeDependency( self $dependency ) : void {
		foreach( $dependency->data['docMethods'] as $name => $methods ) {
			foreach( $methods as $method ) {
				$this->data['docMethods'][$name][] = $method;
			}
		}

		foreach( $dependency->data['methods'] as $name => $methods ) {
			foreach( $methods as $method ) {
				$this->data['methods'][$name][] = $method;
			}
		}

		foreach( $dependency->data['constants'] as $name => $constants ) {
			foreach( $constants as $constant ) {
				$this->data['constants'][$name][] = $constant;
			}
		}

		foreach( $dependency->data['properties'] as $name => $properties ) {
			foreach( $properties as $property ) {
				$this->data['properties'][$name][] = $property;
			}
		}
	}

	/** @return array<string,list<Tag>> */
	public function getDocMethods() : array {
		return $this->data['docMethods'];
	}

	/** @return array<string,list<Element>> */
	public function getMethods() : array {
		return $this->data['methods'];
	}

	/** @return array<string,list<Element>> */
	public function getConstants() : array {
		return $this->data['constants'];
	}

	/** @return array<string,list<Element>> */
	public function getProperties() : array {
		return $this->data['properties'];
	}

}
