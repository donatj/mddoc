<?php

namespace donatj\MDDoc\Reflectors;

use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Use_;
use PhpParser\NodeVisitor\NameResolver;

/** @mddoc-ignore */
final class LanguageLiteralNameResolver extends NameResolver {

	private const LANGUAGE_LITERALS = [ 'false', 'null', 'true' ];

	protected function resolveName( Name $name, int $type ) : Name {
		if(
			$type === Use_::TYPE_CONSTANT
			&& !($name instanceof FullyQualified)
			&& in_array(strtolower($name->toString()), self::LANGUAGE_LITERALS, true)
		) {
			return $name;
		}

		return parent::resolveName($name, $type);
	}

}
