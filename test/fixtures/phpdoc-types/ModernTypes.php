<?php

namespace MDDocTest;

/**
 * A source file that uses PHPDoc types beyond phpDocumentor/reflection's grammar.
 *
 * @method static array<string,int> find(callable(string|int): bool $filter) Finds matching values.
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

	/** @return mixed */
	public function dnf( (\Countable&\Iterator)|\Stringable $value ) : (\Countable&\Iterator)|\Stringable {
	}

}
