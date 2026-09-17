<?php

namespace donatj\MDDoc\Reflectors\Source;

use PHPStan\PhpDocParser\Ast\PhpDoc\GenericTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\InvalidTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\MethodTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\ParamTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\ThrowsTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\TypeAliasTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
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
	 * @param array<string,true> $typeNames
	 */
	public function parse( ?string $comment, string $namespace = '', array $imports = [], array $typeNames = [] ) : ?DocBlock {
		if( $comment === null ) {
			return null;
		}

		$doc = $this->parser->parse(new TokenIterator($this->lexer->tokenize($comment)));

		foreach( $doc->children as $child ) {
			if( !$child instanceof PhpDocTagNode ) {
				continue;
			}

			if( $child->value instanceof TemplateTagValueNode ) {
				$typeNames[$child->value->name] = true;
			} elseif( $child->value instanceof TypeAliasTagValueNode ) {
				$typeNames[$child->value->alias] = true;
			}
		}

		$typeFormatter = new PhpDocTypeFormatter($namespace, $imports, $typeNames);
		$tags          = [];
		foreach( $doc->children as $child ) {
			if( $child instanceof PhpDocTagNode ) {
				$tag = $this->tagFromNode($child, $typeFormatter);
				$tags[$tag->getName()][] = $tag;
			}
		}

		list($summary, $description) = $this->splitText($this->textFromComment($comment));

		return new DocBlock($summary, $description, $tags, $typeNames);
	}

	private function tagFromNode( PhpDocTagNode $node, PhpDocTypeFormatter $typeFormatter ) : Tag {
		$name  = ltrim($node->name, '@');
		$value = $node->value;

		if( $value instanceof ParamTagValueNode ) {
			return new Tag(
				$name,
				$typeFormatter->format($value->type),
				$this->normaliseTagDescription($value->description),
				ltrim($value->parameterName, '$')
			);
		}

		if( $value instanceof ReturnTagValueNode || $value instanceof ThrowsTagValueNode ) {
			return new Tag($name, $typeFormatter->format($value->type), $this->normaliseTagDescription($value->description));
		}

		if( $value instanceof VarTagValueNode ) {
			return new Tag(
				$name,
				$typeFormatter->format($value->type),
				$this->normaliseTagDescription($value->description),
				ltrim($value->variableName, '$')
			);
		}

		if( $value instanceof MethodTagValueNode ) {
			$args = [];
			foreach( $value->parameters as $parameter ) {
				$args[] = [
					'name' => ltrim($parameter->parameterName, '$'),
					'type' => $parameter->type === null ? 'mixed' : $typeFormatter->format($parameter->type),
				];
			}

			return new Tag(
				$name,
				$value->returnType === null ? 'mixed' : $typeFormatter->format($value->returnType),
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
