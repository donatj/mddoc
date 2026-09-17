<?php

namespace donatj\MDDoc\Reflectors\Source;

use PHPStan\PhpDocParser\Ast\PhpDoc\GenericTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\InvalidTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\MethodTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\ParamTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\ThrowsTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use PHPStan\PhpDocParser\Ast\Type\ArrayShapeNode;
use PHPStan\PhpDocParser\Ast\Type\ArrayTypeNode;
use PHPStan\PhpDocParser\Ast\Type\CallableTypeNode;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IntersectionTypeNode;
use PHPStan\PhpDocParser\Ast\Type\NullableTypeNode;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;
use PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser as PhpStanDocBlockParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\PhpDocParser\ParserConfig;

/** @mddoc-ignore */
class DocBlockParser {

	private Lexer $lexer;
	private PhpStanDocBlockParser $parser;

	public function __construct() {
		$config    = new ParserConfig([]);
		$constants = new ConstExprParser($config);

		$this->lexer  = new Lexer($config);
		$this->parser = new PhpStanDocBlockParser($config, new TypeParser($config, $constants), $constants);
	}

	/**
	 * @param array<string,string> $imports
	 */
	public function parse( ?string $comment, string $namespace = '', array $imports = [] ) : ?DocBlock {
		if( $comment === null ) {
			return null;
		}

		$doc = $this->parser->parse(new TokenIterator($this->lexer->tokenize($comment)));

		$tags = [];
		foreach( $doc->children as $child ) {
			if( $child instanceof PhpDocTagNode ) {
				$tag = $this->tagFromNode($child, $namespace, $imports);
				$tags[$tag->getName()][] = $tag;
			}
		}

		list($summary, $description) = $this->splitText($this->textFromComment($comment));

		return new DocBlock($summary, $description, $tags);
	}

	/**
	 * @param array<string,string> $imports
	 */
	private function tagFromNode( PhpDocTagNode $node, string $namespace, array $imports ) : Tag {
		$name  = ltrim($node->name, '@');
		$value = $node->value;

		if( $value instanceof ParamTagValueNode ) {
			return new Tag(
				$name,
				$this->formatType($value->type, $namespace, $imports),
				$this->normaliseTagDescription($value->description),
				ltrim($value->parameterName, '$')
			);
		}

		if( $value instanceof ReturnTagValueNode || $value instanceof ThrowsTagValueNode ) {
			return new Tag($name, $this->formatType($value->type, $namespace, $imports), $this->normaliseTagDescription($value->description));
		}

		if( $value instanceof VarTagValueNode ) {
			return new Tag(
				$name,
				$this->formatType($value->type, $namespace, $imports),
				$this->normaliseTagDescription($value->description),
				ltrim($value->variableName, '$')
			);
		}

		if( $value instanceof MethodTagValueNode ) {
			$args = [];
			foreach( $value->parameters as $parameter ) {
				$args[] = [
					'name' => ltrim($parameter->parameterName, '$'),
					'type' => $parameter->type === null ? 'mixed' : $this->formatType($parameter->type, $namespace, $imports),
				];
			}

			return new Tag(
				$name,
				$value->returnType === null ? 'mixed' : $this->formatType($value->returnType, $namespace, $imports),
				$this->normaliseTagDescription($value->description),
				'',
				$value->methodName,
				$value->isStatic,
				$args
			);
		}

		if( $value instanceof GenericTagValueNode ) {
			return new Tag($name, null, $value->value);
		}

		if( $value instanceof InvalidTagValueNode ) {
			return new Tag($name, null, $value->exception->getMessage(), '', '', false, [], false);
		}

		return new Tag($name, null, (string)$value);
	}

	/**
	 * @param array<string,string> $imports
	 */
	private function formatType( TypeNode $type, string $namespace, array $imports ) : string {
		if( $type instanceof ArrayTypeNode ) {
			$innerType = $this->formatType($type->type, $namespace, $imports);
			if( $type->type instanceof UnionTypeNode || $type->type instanceof IntersectionTypeNode || $type->type instanceof NullableTypeNode ) {
				$innerType = "({$innerType})";
			}

			return $innerType . '[]';
		}

		if( $type instanceof ArrayShapeNode ) {
			$items = [];
			foreach( $type->items as $item ) {
				$key     = $item->keyName === null ? '' : $item->keyName . ($item->optional ? '?' : '') . ': ';
				$items[] = $key . $this->formatType($item->valueType, $namespace, $imports);
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
				$parameters[] = $this->formatType($parameter->type, $namespace, $imports) .
					($suffix === '' ? '' : ' ' . $suffix) .
					($parameter->isOptional ? '=' : '');
			}

			return $this->resolveIdentifier($type->identifier->name, $namespace, $imports) .
				'(' . implode(',', $parameters) . '): ' .
				$this->formatType($type->returnType, $namespace, $imports);
		}

		if( $type instanceof UnionTypeNode || $type instanceof IntersectionTypeNode ) {
			$separator = $type instanceof UnionTypeNode ? '|' : '&';
			$types     = [];
			foreach( $type->types as $member ) {
				$types[] = $this->formatType($member, $namespace, $imports);
			}

			return implode($separator, $types);
		}

		if( $type instanceof NullableTypeNode ) {
			return '?' . $this->formatType($type->type, $namespace, $imports);
		}

		if( $type instanceof GenericTypeNode ) {
			$types = [];
			foreach( $type->genericTypes as $index => $member ) {
				$variance = $type->variances[$index] ?? GenericTypeNode::VARIANCE_INVARIANT;
				if( $variance === GenericTypeNode::VARIANCE_BIVARIANT ) {
					$types[] = '*';
					continue;
				}

				$types[] =
					($variance === GenericTypeNode::VARIANCE_INVARIANT ? '' : $variance . ' ') .
					$this->formatType($member, $namespace, $imports);
			}

			if( (string)$type->type === 'array' && count($types) === 1 ) {
				return $types[0] . '[]';
			}

			return $type->type . '<' . implode(',', $types) . '>';
		}

		if( $type instanceof IdentifierTypeNode ) {
			return $this->resolveIdentifier($type->name, $namespace, $imports);
		}

		return preg_replace('/\s*([|&,])\s*/', '$1', (string)$type);
	}

	/**
	 * @param array<string,string> $imports
	 */
	private function resolveIdentifier( string $name, string $namespace, array $imports ) : string {
		if( $name === '' || $name[0] === '\\' || in_array(strtolower($name), [
			'array', 'bool', 'boolean', 'callable', 'class-string', 'closed-resource', 'false',
			'float', 'int', 'integer', 'iterable', 'list', 'mixed', 'never', 'null', 'numeric',
			'object', 'open-resource', 'parent', 'positive-int', 'resource', 'scalar', 'self',
			'static', 'string', 'true', 'void',
		], true) ) {
			return $name;
		}

		$parts = explode('\\', $name, 2);
		$alias = strtolower($parts[0]);
		if( isset($imports[$alias]) ) {
			return '\\' . $imports[$alias] . (isset($parts[1]) ? '\\' . $parts[1] : '');
		}

		return $namespace === '' ? $name : '\\' . $namespace . '\\' . $name;
	}

	private function normaliseTagDescription( string $description ) : string {
		return preg_replace('/\n[ \t]+/', "\n", $description);
	}

	private function textFromComment( string $comment ) : string {
		$comment = preg_replace('/^\s*\/\*\*\s?|\s*\*\/\s*$/', '', $comment);
		$lines   = preg_split('/\r?\n/', $comment);
		$text    = [];
		$inFence = false;

		foreach( $lines as $line ) {
			$line = preg_replace('/^\s*\* ?/', '', $line);
			if( strpos(ltrim($line), '```') === 0 ) {
				$inFence = !$inFence;
			} elseif( !$inFence && (
				preg_match('/^ {3}(?=`|\*|---)/', $line)
				|| preg_match('/^ {1,3}(?=[A-Za-z_][A-Za-z0-9_]*::)/', $line)
			) ) {
				$line = ltrim($line);
			}

			if( preg_match('/^\s*@/', $line) ) {
				break;
			}

			$text[] = rtrim($line);
		}

		return $this->normaliseFencedBlocks(trim(implode("\n", $text)));
	}

	private function normaliseFencedBlocks( string $text ) : string {
		$normalised = [];
		$block      = [];
		$inFence    = false;

		foreach( preg_split('/\r?\n/', $text) as $line ) {
			if( strpos(ltrim($line), '```') === 0 ) {
				$block[] = $line;
				if( $inFence ) {
					$normalised = array_merge($normalised, $this->trimCommonIndent($block));
					$block      = [];
				}

				$inFence = !$inFence;
			} elseif( $inFence ) {
				$block[] = $line;
			} else {
				$normalised[] = $line;
			}
		}

		return implode("\n", array_merge($normalised, $block));
	}

	/**
	 * @param string[] $lines
	 * @return string[]
	 */
	private function trimCommonIndent( array $lines ) : array {
		$indent = null;
		foreach( $lines as $line ) {
			if( trim($line) === '' ) {
				continue;
			}

			$length = strspn($line, " \t");
			$indent = $indent === null ? $length : min($indent, $length);
		}

		if( !$indent ) {
			return $lines;
		}

		return array_map(function ( string $line ) use ( $indent ) : string {
			return substr($line, 0, $indent) === str_repeat(' ', $indent) ? substr($line, $indent) : $line;
		}, $lines);
	}

	/**
	 * @return string[]
	 */
	private function splitText( string $text ) : array {
		$text = trim($text);
		if( $text === '' ) {
			return [ '', '' ];
		}

		$summaryLines     = [];
		$descriptionLines = [];
		$inDescription    = false;

		foreach( preg_split('/\r?\n/', $text) as $line ) {
			if( !$inDescription ) {
				if( trim($line) === '' ) {
					$inDescription = true;
					continue;
				}

				$summaryLines[] = $line;
				if( preg_match('/[.!?]$/', rtrim($line)) ) {
					$inDescription = true;
				}
			} else {
				$descriptionLines[] = $line;
			}
		}

		$summary     = trim(implode("\n", $summaryLines));
		$description = trim(implode("\n", $descriptionLines));

		return [ $summary, $description ];
	}

}
