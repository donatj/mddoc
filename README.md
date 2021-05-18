# MDDoc

[![Latest Stable Version](https://poser.pugx.org/donatj/mddoc/version)](https://packagist.org/packages/donatj/mddoc)
[![Total Downloads](https://poser.pugx.org/donatj/mddoc/downloads)](https://packagist.org/packages/donatj/mddoc)
[![License](https://poser.pugx.org/donatj/mddoc/license)](https://packagist.org/packages/donatj/mddoc)


A simple, directed phpDoc => Markdown generator.

This is a work in progress and not ready for use.

This projects goal is to be able to define a set of directions for *how* to document a set of PHP files as well as markdown and other text to include, and output the final documentation in a jekyll or other markdown site builder ready form.


## Requirements

- **php**: >=7.1
- **ext-dom**: *
- **ext-json**: *
- **donatj/flags**: ~1.4
- **donatj/cli-toolkit**: ~0.2
- **donatj/mddom**: ~0.1.0
- **phpdocumentor/reflection**: ~4.0

## Documentation Example (WIP)

### Class: \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface



#### Undocumented Method: `AutoloaderInterface->__invoke(string $className)`

### Class: \donatj\MDDoc\Autoloaders\NullLoader



#### Undocumented Method: `NullLoader->__invoke(string $className)`

### Class: \donatj\MDDoc\Autoloaders\Psr0

Class Psr0

#### Method: Psr0->__construct

```php
function __construct(string $path)
```

##### Parameters:

- ***string*** `$path` - Root path

---

#### Undocumented Method: `Psr0->__invoke(string $className)`

### Class: \donatj\MDDoc\Autoloaders\Psr4

Class Psr4

#### Method: Psr4->__construct

```php
function __construct(string $root_namespace, string $path)
```

##### Parameters:

- ***string*** `$root_namespace` - Namespace prefix
- ***string*** `$path` - Root path

---

#### Undocumented Method: `Psr4->__invoke(string $className)`

### Class: \donatj\MDDoc\Documentation\AbstractDocPart



#### Undocumented Method: `AbstractDocPart->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

#### Undocumented Method: `AbstractDocPart->setOptionDefault(string $key, ?string $value)`

---

#### Undocumented Method: `AbstractDocPart->getOption(string $key [, bool $tree = false])`

---

#### Undocumented Method: `AbstractDocPart->setParent(\donatj\MDDoc\Documentation\AbstractDocPart $parent)`

---

#### Undocumented Method: `AbstractDocPart->getParent()`

### Class: \donatj\MDDoc\Documentation\AbstractNestedDoc

#### Method: AbstractNestedDoc->getChildren

```php
function getChildren() : array
```

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

#### Method: AbstractNestedDoc->setChildren

```php
function setChildren($children)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`

---

#### Undocumented Method: `AbstractNestedDoc->addChild(\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface $child)`

### Class: \donatj\MDDoc\Documentation\Badges\Badge

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class Badge {
	public const OPT_ALT = 'alt';
	public const OPT_SRC = 'src';
	public const OPT_HREF = 'href';
	public const OPT_TITLE = 'title';
}
```



#### Undocumented Method: `Badge->output(int $depth)`

### Class: \donatj\MDDoc\Documentation\Badges\BadgeGitHubActions

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeGitHubActions {
	public const OPT_BRANCH = 'branch';
	public const OPT_EVENT = 'event';
}
```

### Class: \donatj\MDDoc\Documentation\Badges\BadgePoser

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgePoser {
	public const OPT_SUFFIX = 'suffix';
}
```

### Class: \donatj\MDDoc\Documentation\Badges\BadgeScrutinizer

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeScrutinizer {
	public const OPT_SUFFIX = 'suffix';
	public const OPT_BRANCH = 'branch';
}
```

### Class: \donatj\MDDoc\Documentation\Badges\BadgeTravis

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeTravis {
	public const OPT_BRANCH = 'branch';
}
```

### Class: \donatj\MDDoc\Documentation\ClassFile



#### Undocumented Method: `ClassFile->output(int $depth)`

---

#### Undocumented Method: `ClassFile->setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader)`

---

#### Undocumented Method: `ClassFile->getDocStr(\phpDocumentor\Reflection\DocBlock $block)`

### Class: \donatj\MDDoc\Documentation\ComposerInstall

#### Method: ComposerInstall->output

```php
function output(int $depth)
```

### Class: \donatj\MDDoc\Documentation\ComposerRequires

#### Method: ComposerRequires->output

```php
function output(int $depth)
```

### Class: \donatj\MDDoc\Documentation\DocPage



#### Undocumented Method: `DocPage->output(int $depth)`

### Class: \donatj\MDDoc\Documentation\DocRoot



#### Undocumented Method: `DocRoot->output(int $depth)`

### Class: \donatj\MDDoc\Documentation\DocumentationFactory

Links XML Tags to their Given Documentation Generator

#### Method: DocumentationFactory->makeFromTag

```php
function makeFromTag(string $tagName, \donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent) : \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface
```

Return a populated DocumentationInterface of the corresponding tagName

### Class: \donatj\MDDoc\Documentation\Exceptions\ExecutionException

### Class: \donatj\MDDoc\Documentation\Exceptions\UnhandledConfigTagException

### Class: \donatj\MDDoc\Documentation\ExecOutput

```php
<?php
namespace donatj\MDDoc\Documentation;

class ExecOutput {
	public const FORMAT_DEFAULT = 'default';
	public const FORMAT_RAW = 'raw';
	public const FORMAT_CODE = 'code';
	public const FORMAT_CODE_BLOCK = 'code-block';
}
```

#### Method: ExecOutput->output

```php
function output(int $depth)
```

##### Returns:

- ***\donatj\MDDom\Code*** | ***\donatj\MDDom\CodeBlock*** | ***\donatj\MDDom\Paragraph*** | ***string***

### Class: \donatj\MDDoc\Documentation\IncludeFile

#### Method: IncludeFile->output

```php
function output(int $depth)
```

##### Returns:

- ***\donatj\MDDom\Paragraph***

### Class: \donatj\MDDoc\Documentation\Interfaces\AutoloaderAware



#### Undocumented Method: `AutoloaderAware->setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader)`

### Class: \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface



#### Undocumented Method: `DocumentationInterface->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

#### Method: DocumentationInterface->output

```php
function output(int $depth)
```

##### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

### Class: \donatj\MDDoc\Documentation\RecursiveDirectory



#### Undocumented Method: `RecursiveDirectory->setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader)`

---

#### Undocumented Method: `RecursiveDirectory->output(int $depth)`

### Class: \donatj\MDDoc\Documentation\Section



#### Undocumented Method: `Section->output(int $depth)`

### Class: \donatj\MDDoc\Documentation\Source

Class Source

#### Method: Source->output

```php
function output(int $depth)
```

##### Returns:

- ***string***

### Class: \donatj\MDDoc\Documentation\Text

Class Text



#### Undocumented Method: `Text->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $text = ''])`

---

#### Undocumented Method: `Text->output(int $depth)`

### Class: \donatj\MDDoc\Exceptions\ClassNotReadableException

### Class: \donatj\MDDoc\Exceptions\ConfigException

### Class: \donatj\MDDoc\Exceptions\MDDocException

### Class: \donatj\MDDoc\Exceptions\PathNotReadableException



#### Undocumented Method: `PathNotReadableException->__construct(string $message, string $path [, ?\Exception $previous_exception = null])`

---

#### Undocumented Method: `PathNotReadableException->getPath()`

### Class: \donatj\MDDoc\Exceptions\TargetNotWritableException

### Class: \donatj\MDDoc\MDDoc

Application MDDoc

```php
<?php
namespace donatj\MDDoc;

class MDDoc {
	public const VERSION = "0.0.1a";
}
```



#### Undocumented Method: `MDDoc->__construct(array $args)`

### Class: \donatj\MDDoc\Reflectors\TaxonomyReflector

#### Method: TaxonomyReflector->__construct

```php
function __construct(string $filename, \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader, \donatj\MDDoc\Reflectors\TaxonomyReflectorFactory $parserFactory)
```

---

#### Method: TaxonomyReflector->getReflector

```php
function getReflector() : \phpDocumentor\Reflection\Element
```

##### Returns:

- ***\phpDocumentor\Reflection\Php\Class_*** | ***\phpDocumentor\Reflection\Php\Interface_*** | ***\phpDocumentor\Reflection\Php\Trait_*** | ***null***

---

#### Method: TaxonomyReflector->getMethods

```php
function getMethods() : array
```

##### Returns:

- ***\phpDocumentor\Reflection\Php\Method[][]***

---

#### Method: TaxonomyReflector->getConstants

```php
function getConstants() : array
```

##### Returns:

- ***\phpDocumentor\Reflection\Php\Constant[][]***

---

#### Method: TaxonomyReflector->getProperties

```php
function getProperties() : array
```

##### Returns:

- ***\phpDocumentor\Reflection\Php\Property[][]***

### Class: \donatj\MDDoc\Reflectors\TaxonomyReflectorFactory

#### Method: TaxonomyReflectorFactory->newInstance

```php
function newInstance(string $filename, \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader) : \donatj\MDDoc\Reflectors\TaxonomyReflector
```

### Class: \donatj\MDDoc\Runner\ConfigParser



#### Undocumented Method: `ConfigParser->__construct([ ?\donatj\MDDoc\Documentation\DocumentationFactory $documentationFactory = null])`

---

#### Method: ConfigParser->parse

```php
function parse(string $filename) : \donatj\MDDoc\Documentation\DocRoot
```

Parse a config file

##### Returns:

- ***\donatj\MDDoc\Documentation\DocRoot***

### Class: \donatj\MDDoc\Runner\ImmutableAttributeTree

ImmutableAttributeTree is a helper for reading XML Attributes

#### Method: ImmutableAttributeTree->withAttr

```php
function withAttr(array $attributes) : self
```

Returns a clone of this ImmutableAttributeTree with another depth of attributes appended.

##### Returns:

- ***$this*** - Clone of current ImmutableAttributeTree

---

#### Method: ImmutableAttributeTree->shallowValue

```php
function shallowValue(string $attr) : ?string
```

Fetch an attribute value by key from the top-most element.

##### Returns:

- ***string*** | ***null*** - Returns null on not found.

---

#### Method: ImmutableAttributeTree->deepValue

```php
function deepValue(string $attr) : ?string
```

Fetch the first attribute value by key from the starting with the top-most element and working up to the root.

##### Returns:

- ***string*** | ***null*** - Returns null on not found.

### Class: \donatj\MDDoc\Runner\UserInterface

#### Method: UserInterface->__construct

```php
function __construct($STDOUT, $STDERR)
```

UserInterface constructor.

##### Parameters:

- ***resource*** `$STDOUT`
- ***resource*** `$STDERR`

---

#### Undocumented Method: `UserInterface->dumpOptions(string $additional)`

---

#### Method: UserInterface->dropError

```php
function dropError(string $text [, int $code = 1 [, ?string $additional = null]]) : void
```

Output an Error before exiting with given error code

##### Parameters:

- ***string*** `$text` - Primary error log details
- ***int*** `$code` - Status code to exit with (0-255)
- ***string*** | ***null*** `$additional` - Optional - will print on a second line following the log

---

#### Undocumented Method: `UserInterface->outputMsg(string $text)`