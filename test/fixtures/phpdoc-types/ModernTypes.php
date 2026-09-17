<?php

namespace MDDocTest;

use Psr\Log\LoggerInterface as Logger;

/**
 * A source file that uses PHPDoc types beyond phpDocumentor/reflection's grammar.
 *
 * @method static array<string,int> find(callable(string|int): bool $filter) Finds matching values.
 * @template T
 * @phpstan-type Item array-key
 */
class ModernTypes {

	/** @var array{label: string, callback: callable(string|int): bool} */
	public $shape;

	/**
	 * Process values with a callback.
	 *
	 * @param array<string> $names Names to process.
	 * @param callable(string|int): bool $filter Decides whether a value is included.
	 * @param callable(string $value, int ...$values): bool $formatter Formats a value.
	 * @return array{items: list<string>, count: positive-int} Processed values and their count.
	 * @throws \RuntimeException When processing fails.
	 */
	public function process( $names, $filter, $formatter ) {
	}

	/**
	 * @param (string|int)[] $compound
	 */
	public function compoundArray( $compound ) {
	}

	/**
	 * @param iterable<covariant string, contravariant int, *> $variance
	 */
	public function variance( $variance ) {
	}

	/**
	 * @param Logger<string> $loggers
	 */
	public function genericAlias( $loggers ) {
	}

	/**
	 * @param T $template
	 * @param Item $item
	 * @param array-key $key
	 */
	public function contextualTypes( $template, $item, $key ) {
	}

	/**
	 * @param \Countable&(\Iterator|\Stringable) $intersection
	 */
	public function compoundIntersection( $intersection ) {
	}

	/**
	 * @param (\Countable&\Iterator)|\Stringable $union
	 */
	public function compoundUnion( $union ) {
	}

	/**
	 * @param ?(\Countable|\Iterator) $nullable
	 */
	public function nullableCompound( $nullable ) {
	}

	/** @return mixed */
	public function dnf( (\Countable&\Iterator)|\Stringable $value ) : (\Countable&\Iterator)|\Stringable {
	}

}
