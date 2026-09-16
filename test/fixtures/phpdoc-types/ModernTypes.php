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
	 * @return array{items: list<string>, count: positive-int} Processed values and their count.
	 * @throws \RuntimeException When processing fails.
	 */
	public function process( $names, $filter ) {
	}

}
