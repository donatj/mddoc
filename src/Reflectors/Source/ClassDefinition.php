<?php

namespace donatj\MDDoc\Reflectors\Source;

/** @mddoc-ignore */
final class ClassDefinition {

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

	public function withDocMethod( Tag $method ) : self {
		$definition = clone $this;
		$definition->data['docMethods'][$method->getMethodName()][] = $method;

		return $definition;
	}

	public function withMethod( Element $method ) : self {
		$definition = clone $this;
		$definition->data['methods'][$method->getName()][] = $method;

		return $definition;
	}

	public function withConstant( Element $constant ) : self {
		$definition = clone $this;
		$definition->data['constants'][$constant->getName()][] = $constant;

		return $definition;
	}

	public function withProperty( Element $property ) : self {
		$definition = clone $this;
		$definition->data['properties'][$property->getName()][] = $property;

		return $definition;
	}

	public function withDependency( string $dependency ) : self {
		$definition = clone $this;
		$definition->dependencies[] = $dependency;

		return $definition;
	}

	/** @return list<string> */
	public function getDependencies() : array {
		return $this->dependencies;
	}

	public function withMergedDependency( self $dependency ) : self {
		$definition = clone $this;
		foreach( $dependency->data['docMethods'] as $name => $methods ) {
			foreach( $methods as $method ) {
				$definition->data['docMethods'][$name][] = $method;
			}
		}

		foreach( $dependency->data['methods'] as $name => $methods ) {
			foreach( $methods as $method ) {
				$definition->data['methods'][$name][] = $method;
			}
		}

		foreach( $dependency->data['constants'] as $name => $constants ) {
			foreach( $constants as $constant ) {
				$definition->data['constants'][$name][] = $constant;
			}
		}

		foreach( $dependency->data['properties'] as $name => $properties ) {
			foreach( $properties as $property ) {
				$definition->data['properties'][$name][] = $property;
			}
		}

		return $definition;
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
