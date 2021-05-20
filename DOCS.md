# Full API Docs (WIP)

## Class: \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface

### Method: AutoloaderInterface->__invoke

```php
function __invoke(string $className) : ?string
```

Locate the filename of a given class

#### Returns:

- ***string*** | ***null*** - filename on class found, null on not found

## Class: \donatj\MDDoc\Autoloaders\NullLoader

### Method: NullLoader->__invoke

```php
function __invoke(string $className) : ?string
```

Locate the filename of a given class

#### Returns:

- ***string*** | ***null*** - filename on class found, null on not found

## Class: \donatj\MDDoc\Autoloaders\Psr0

Class Psr0

### Method: Psr0->__construct

```php
function __construct(string $path)
```

#### Parameters:

- ***string*** `$path` - Root path

---

### Method: Psr0->__invoke

```php
function __invoke(string $className) : ?string
```

Locate the filename of a given class

#### Returns:

- ***string*** | ***null*** - filename on class found, null on not found

## Class: \donatj\MDDoc\Autoloaders\Psr4

Class Psr4

### Method: Psr4->__construct

```php
function __construct(string $root_namespace, string $path)
```

#### Parameters:

- ***string*** `$root_namespace` - Namespace prefix
- ***string*** `$path` - Root path

---

### Method: Psr4->__invoke

```php
function __invoke(string $className) : ?string
```

Locate the filename of a given class

#### Returns:

- ***string*** | ***null*** - filename on class found, null on not found

## Class: \donatj\MDDoc\Documentation\AbstractDocPart



### Method: `AbstractDocPart->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `AbstractDocPart->setOptionDefault(string $key, ?string $value)`

---

### Method: `AbstractDocPart->getParent()`

---

### Method: AbstractDocPart->output

```php
function output(int $depth)
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

## Class: \donatj\MDDoc\Documentation\AbstractNestedDoc

### Method: AbstractNestedDoc->getChildren

```php
function getChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### Method: `AbstractNestedDoc->addChildren(\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface ...$children)`

---

### Method: `AbstractNestedDoc->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `AbstractNestedDoc->setOptionDefault(string $key, ?string $value)`

---

### Method: `AbstractNestedDoc->getParent()`

---

### Method: AbstractNestedDoc->output

```php
function output(int $depth)
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

## Class: \donatj\MDDoc\Documentation\Badges\Badge

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

### Method: Badge->output

```php
function output(int $depth) : string
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `Badge->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `Badge->setOptionDefault(string $key, ?string $value)`

---

### Method: `Badge->getParent()`

## Class: \donatj\MDDoc\Documentation\Badges\BadgeGitHubActions

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeGitHubActions {
	public const OPT_BRANCH = 'branch';
	public const OPT_EVENT = 'event';
	public const OPT_ALT = 'alt';
	public const OPT_SRC = 'src';
	public const OPT_HREF = 'href';
	public const OPT_TITLE = 'title';
}
```

---

### Method: BadgeGitHubActions->output

```php
function output(int $depth) : string
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `BadgeGitHubActions->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `BadgeGitHubActions->setOptionDefault(string $key, ?string $value)`

---

### Method: `BadgeGitHubActions->getParent()`

## Class: \donatj\MDDoc\Documentation\Badges\BadgePoser

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgePoser {
	public const OPT_SUFFIX = 'suffix';
	public const OPT_ALT = 'alt';
	public const OPT_SRC = 'src';
	public const OPT_HREF = 'href';
	public const OPT_TITLE = 'title';
}
```

---

### Method: BadgePoser->output

```php
function output(int $depth) : string
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `BadgePoser->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `BadgePoser->setOptionDefault(string $key, ?string $value)`

---

### Method: `BadgePoser->getParent()`

## Class: \donatj\MDDoc\Documentation\Badges\BadgeScrutinizer

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeScrutinizer {
	public const OPT_SUFFIX = 'suffix';
	public const OPT_BRANCH = 'branch';
	public const OPT_ALT = 'alt';
	public const OPT_SRC = 'src';
	public const OPT_HREF = 'href';
	public const OPT_TITLE = 'title';
}
```

---

### Method: BadgeScrutinizer->output

```php
function output(int $depth) : string
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `BadgeScrutinizer->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `BadgeScrutinizer->setOptionDefault(string $key, ?string $value)`

---

### Method: `BadgeScrutinizer->getParent()`

## Class: \donatj\MDDoc\Documentation\Badges\BadgeTravis

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeTravis {
	public const OPT_BRANCH = 'branch';
	public const OPT_ALT = 'alt';
	public const OPT_SRC = 'src';
	public const OPT_HREF = 'href';
	public const OPT_TITLE = 'title';
}
```

---

### Method: BadgeTravis->output

```php
function output(int $depth) : string
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `BadgeTravis->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `BadgeTravis->setOptionDefault(string $key, ?string $value)`

---

### Method: `BadgeTravis->getParent()`

## Class: \donatj\MDDoc\Documentation\ClassFile

### Method: ClassFile->output

```php
function output(int $depth)
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string***

---

### Method: `ClassFile->setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader)`

---

### Method: `ClassFile->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `ClassFile->setOptionDefault(string $key, ?string $value)`

---

### Method: `ClassFile->getParent()`

## Class: \donatj\MDDoc\Documentation\ComposerInstall

### Method: ComposerInstall->output

```php
function output(int $depth) : \donatj\MDDom\Paragraph
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `ComposerInstall->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `ComposerInstall->setOptionDefault(string $key, ?string $value)`

---

### Method: `ComposerInstall->getParent()`

## Class: \donatj\MDDoc\Documentation\ComposerRequires

### Method: ComposerRequires->output

```php
function output(int $depth) : \donatj\MDDom\Paragraph
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `ComposerRequires->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `ComposerRequires->setOptionDefault(string $key, ?string $value)`

---

### Method: `ComposerRequires->getParent()`

## Class: \donatj\MDDoc\Documentation\DocPage

### Method: DocPage->output

```php
function output(int $depth) : string
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `DocPage->setUI(\donatj\MDDoc\Runner\TextUI $ui)`

---

### Method: DocPage->getChildren

```php
function getChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### Method: `DocPage->addChildren(\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface ...$children)`

---

### Method: `DocPage->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `DocPage->setOptionDefault(string $key, ?string $value)`

---

### Method: `DocPage->getParent()`

## Class: \donatj\MDDoc\Documentation\DocRoot

### Method: DocRoot->output

```php
function output(int $depth)
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: DocRoot->getChildren

```php
function getChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### Method: `DocRoot->addChildren(\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface ...$children)`

---

### Method: `DocRoot->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `DocRoot->setOptionDefault(string $key, ?string $value)`

---

### Method: `DocRoot->getParent()`

## Class: \donatj\MDDoc\Documentation\DocumentationFactory

Links XML Tags to their Given Documentation Generator

### Method: DocumentationFactory->__construct

```php
function __construct(\donatj\MDDoc\Runner\TextUI $ui)
```

DocumentationFactory constructor.

---

### Method: DocumentationFactory->makeFromTag

```php
function makeFromTag(string $tagName, \donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent) : \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface
```

Return a populated DocumentationInterface of the corresponding tagName

## Class: \donatj\MDDoc\Documentation\Exceptions\ExecutionException

## Class: \donatj\MDDoc\Documentation\Exceptions\UnhandledConfigTagException

## Class: \donatj\MDDoc\Documentation\ExecOutput

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

### Method: ExecOutput->output

```php
function output(int $depth) : \donatj\MDDom\AbstractElement
```

---

### Method: `ExecOutput->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `ExecOutput->setOptionDefault(string $key, ?string $value)`

---

### Method: `ExecOutput->getParent()`

## Class: \donatj\MDDoc\Documentation\IncludeFile

### Method: IncludeFile->output

```php
function output(int $depth) : \donatj\MDDom\Paragraph
```

---

### Method: `IncludeFile->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `IncludeFile->setOptionDefault(string $key, ?string $value)`

---

### Method: `IncludeFile->getParent()`

## Class: \donatj\MDDoc\Documentation\Interfaces\AutoloaderAware



### Method: `AutoloaderAware->setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader)`

## Class: \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface



### Method: `DocumentationInterface->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: DocumentationInterface->output

```php
function output(int $depth)
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

## Class: \donatj\MDDoc\Documentation\Interfaces\UIAwareDocumentationInterface



### Method: `UIAwareDocumentationInterface->setUI(\donatj\MDDoc\Runner\TextUI $ui)`

## Class: \donatj\MDDoc\Documentation\RecursiveDirectory



### Method: `RecursiveDirectory->setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader)`

---

### Method: RecursiveDirectory->output

```php
function output(int $depth) : \donatj\MDDom\Document
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: RecursiveDirectory->getChildren

```php
function getChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### Method: `RecursiveDirectory->addChildren(\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface ...$children)`

---

### Method: `RecursiveDirectory->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `RecursiveDirectory->setOptionDefault(string $key, ?string $value)`

---

### Method: `RecursiveDirectory->getParent()`

## Class: \donatj\MDDoc\Documentation\Section

### Method: Section->output

```php
function output(int $depth)
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: Section->getChildren

```php
function getChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### Method: `Section->addChildren(\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface ...$children)`

---

### Method: `Section->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree)`

---

### Method: `Section->setOptionDefault(string $key, ?string $value)`

---

### Method: `Section->getParent()`

## Class: \donatj\MDDoc\Documentation\Source

Class Source

### Method: Source->output

```php
function output(int $depth) : \donatj\MDDom\AbstractElement
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `Source->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $text = ''])`

---

### Method: `Source->setOptionDefault(string $key, ?string $value)`

---

### Method: `Source->getParent()`

## Class: \donatj\MDDoc\Documentation\Text

Class Text



### Method: `Text->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $text = ''])`

---

### Method: Text->output

```php
function output(int $depth) : \donatj\MDDom\AbstractElement
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `Text->setOptionDefault(string $key, ?string $value)`

---

### Method: `Text->getParent()`

## Class: \donatj\MDDoc\Exceptions\ClassNotReadableException



### Method: `ClassNotReadableException->__construct(string $message, string $path [, ?\Exception $previous_exception = null])`

---

### Method: `ClassNotReadableException->getPath()`

## Class: \donatj\MDDoc\Exceptions\ConfigException

## Class: \donatj\MDDoc\Exceptions\MDDocException

## Class: \donatj\MDDoc\Exceptions\PathNotReadableException



### Method: `PathNotReadableException->__construct(string $message, string $path [, ?\Exception $previous_exception = null])`

---

### Method: `PathNotReadableException->getPath()`

## Class: \donatj\MDDoc\Exceptions\TargetNotWritableException

## Class: \donatj\MDDoc\MDDoc

Application MDDoc

```php
<?php
namespace donatj\MDDoc;

class MDDoc {
	public const VERSION = "0.0.1";
}
```



### Method: `MDDoc->__construct(array $args)`

## Class: \donatj\MDDoc\Reflectors\TaxonomyReflector

### Method: TaxonomyReflector->__construct

```php
function __construct(string $filename, \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader, \donatj\MDDoc\Reflectors\TaxonomyReflectorFactory $parserFactory)
```

---

### Method: TaxonomyReflector->getReflector

```php
function getReflector() : \phpDocumentor\Reflection\Element
```

#### Returns:

- ***\phpDocumentor\Reflection\Php\Class_*** | ***\phpDocumentor\Reflection\Php\Interface_*** | ***\phpDocumentor\Reflection\Php\Trait_*** | ***null***

---

### Method: TaxonomyReflector->getMethods

```php
function getMethods() : array
```

#### Returns:

- ***\phpDocumentor\Reflection\Php\Method[][]***

---

### Method: TaxonomyReflector->getConstants

```php
function getConstants() : array
```

#### Returns:

- ***\phpDocumentor\Reflection\Php\Constant[][]***

---

### Method: TaxonomyReflector->getProperties

```php
function getProperties() : array
```

#### Returns:

- ***\phpDocumentor\Reflection\Php\Property[][]***

## Class: \donatj\MDDoc\Reflectors\TaxonomyReflectorFactory

### Method: TaxonomyReflectorFactory->newInstance

```php
function newInstance(string $filename, \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader) : \donatj\MDDoc\Reflectors\TaxonomyReflector
```

## Class: \donatj\MDDoc\Runner\ConfigParser



### Method: `ConfigParser->__construct(\donatj\MDDoc\Documentation\DocumentationFactory $documentationFactory)`

---

### Method: ConfigParser->parse

```php
function parse(string $filename) : \donatj\MDDoc\Documentation\DocRoot
```

Parse a config file

#### Returns:

- ***\donatj\MDDoc\Documentation\DocRoot***

## Class: \donatj\MDDoc\Runner\ImmutableAttributeTree

ImmutableAttributeTree is a helper for reading XML Attributes

### Method: ImmutableAttributeTree->withAttr

```php
function withAttr(array $attributes) : self
```

Returns a clone of this ImmutableAttributeTree with another depth of attributes appended.

#### Returns:

- ***$this*** - Clone of current ImmutableAttributeTree

---

### Method: ImmutableAttributeTree->shallowValue

```php
function shallowValue(string $attr) : ?string
```

Fetch an attribute value by key from the top-most element.

#### Returns:

- ***string*** | ***null*** - Returns null on not found.

---

### Method: ImmutableAttributeTree->deepValue

```php
function deepValue(string $attr) : ?string
```

Fetch the first attribute value by key from the starting with the top-most element and working up to the root.

#### Returns:

- ***string*** | ***null*** - Returns null on not found.

## Class: \donatj\MDDoc\Runner\TextUI

### Method: TextUI->__construct

```php
function __construct($STDOUT, $STDERR)
```

UserInterface constructor.

#### Parameters:

- ***resource*** `$STDOUT`
- ***resource*** `$STDERR`

---

### Method: `TextUI->dumpOptions(string $additional)`

---

### Method: TextUI->dropError

```php
function dropError(string $text [, int $code = 1 [, ?string $additional = null]]) : void
```

Output an Error before exiting with given error code

#### Parameters:

- ***string*** `$text` - Primary error log details
- ***int*** `$code` - Status code to exit with (0-255)
- ***string*** | ***null*** `$additional` - Optional - will print on a second line following the log

---

### Method: `TextUI->println([ string $text = ''])`

---

### Method: `TextUI->log(string $text [, bool $timestamp = true])`