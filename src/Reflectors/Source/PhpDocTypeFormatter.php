<?php

namespace donatj\MDDoc\Reflectors\Source;

use PHPStan\PhpDocParser\Ast\Type\ArrayShapeNode;
use PHPStan\PhpDocParser\Ast\Type\ArrayTypeNode;
use PHPStan\PhpDocParser\Ast\Type\CallableTypeNode;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IntersectionTypeNode;
use PHPStan\PhpDocParser\Ast\Type\NullableTypeNode;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;
use PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;

/** @mddoc-ignore */
class PhpDocTypeFormatter {

	private string $namespace;

	/** @var array<string,string> */
	private array $imports;

	/** @var array<string,true> */
	private array $typeNames;

	/**
	 * @param array<string,string> $imports
	 * @param array<string,true> $typeNames
	 */
	public function __construct( string $namespace, array $imports, array $typeNames ) {
		$this->namespace = $namespace;
		$this->imports   = $imports;
		$this->typeNames = $typeNames;
	}

	public function format( TypeNode $type ) : string {
		if( $type instanceof ArrayTypeNode ) {
			$innerType = $this->format($type->type);
			if( $type->type instanceof UnionTypeNode || $type->type instanceof IntersectionTypeNode || $type->type instanceof NullableTypeNode ) {
				$innerType = "({$innerType})";
			}

			return $innerType . '[]';
		}

		if( $type instanceof ArrayShapeNode ) {
			$items = [];
			foreach( $type->items as $item ) {
				$key     = $item->keyName === null ? '' : $item->keyName . ($item->optional ? '?' : '') . ': ';
				$items[] = $key . $this->format($item->valueType);
			}

			if( !$type->sealed ) {
				$items[] = '...' . $type->unsealedType;
			}

			return $type->kind . '{' . implode(',', $items) . '}';
		}

		if( $type instanceof CallableTypeNode ) {
			$parameters = [];
			foreach( $type->parameters as $parameter ) {
				$suffix =
					($parameter->isReference ? '&' : '') .
					($parameter->isVariadic ? '...' : '') .
					$parameter->parameterName;
				$parameters[] = $this->format($parameter->type) .
					($suffix === '' ? '' : ' ' . $suffix) .
					($parameter->isOptional ? '=' : '');
			}

			return $this->resolveIdentifier($type->identifier->name) .
				'(' . implode(',', $parameters) . '): ' .
				$this->format($type->returnType);
		}

		if( $type instanceof UnionTypeNode || $type instanceof IntersectionTypeNode ) {
			$isUnion   = $type instanceof UnionTypeNode;
			$separator = $isUnion ? '|' : '&';
			$types     = [];
			foreach( $type->types as $member ) {
				$memberType = $this->format($member);
				if( ($isUnion && $member instanceof IntersectionTypeNode) || (!$isUnion && $member instanceof UnionTypeNode) ) {
					$memberType = "({$memberType})";
				}

				$types[] = $memberType;
			}

			return implode($separator, $types);
		}

		if( $type instanceof NullableTypeNode ) {
			$innerType = $this->format($type->type);
			if( $type->type instanceof UnionTypeNode || $type->type instanceof IntersectionTypeNode ) {
				$innerType = "({$innerType})";
			}

			return '?' . $innerType;
		}

		if( $type instanceof GenericTypeNode ) {
			$baseType = $this->resolveIdentifier($type->type->name);
			$types = [];
			foreach( $type->genericTypes as $index => $member ) {
				$variance = $type->variances[$index] ?? GenericTypeNode::VARIANCE_INVARIANT;
				if( $variance === GenericTypeNode::VARIANCE_BIVARIANT ) {
					$types[] = '*';
					continue;
				}

				$types[] =
					($variance === GenericTypeNode::VARIANCE_INVARIANT ? '' : $variance . ' ') .
					$this->format($member);
			}

			if( $baseType === 'array' && count($types) === 1 ) {
				return $types[0] . '[]';
			}

			return $baseType . '<' . implode(',', $types) . '>';
		}

		if( $type instanceof IdentifierTypeNode ) {
			return $this->resolveIdentifier($type->name);
		}

		return preg_replace('/\s*([|&,])\s*/', '$1', (string)$type);
	}

	private function resolveIdentifier( string $name ) : string {
		if( $name === '' || $name[0] === '\\' || isset($this->typeNames[$name]) || strpos($name, '-') !== false || in_array(strtolower($name), [
			'array', 'bool', 'boolean', 'callable', 'class-string', 'closed-resource', 'false',
			'float', 'int', 'integer', 'iterable', 'list', 'mixed', 'never', 'null', 'numeric',
			'object', 'open-resource', 'parent', 'positive-int', 'resource', 'scalar', 'self',
			'static', 'string', 'true', 'void',
		], true) ) {
			return $name;
		}

		$parts = explode('\\', $name, 2);
		$alias = strtolower($parts[0]);
		if( isset($this->imports[$alias]) ) {
			return '\\' . $this->imports[$alias] . (isset($parts[1]) ? '\\' . $parts[1] : '');
		}

		return $this->namespace === '' ? $name : '\\' . $this->namespace . '\\' . $name;
	}

}
