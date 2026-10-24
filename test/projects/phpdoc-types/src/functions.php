<?php

use RuntimeException as ImportedException;
use Psr\Log\{LoggerInterface as GroupedLogger};

/**
 * @return ImportedException
 */
function importedException() {
}

/**
 * @return GroupedLogger
 */
function groupedLogger() {
}

function nativeReturn() : int {
}

function optionalParameters( string $required, int $count = 1, ?string $label = null ) {
}

/**
 * A function that does not return a value.
 *
 * @return void
 */
function documentedVoidFunction() : void {
}

/**
 * A function whose void result is documented.
 *
 * @return void Writes output.
 */
function documentedVoidFunctionWithDescription() : void {
}
