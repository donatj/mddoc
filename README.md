# MDDoc

[![Latest Stable Version](https://poser.pugx.org/donatj/mddoc/version)](https://packagist.org/packages/donatj/mddoc)
[![Total Downloads](https://poser.pugx.org/donatj/mddoc/downloads)](https://packagist.org/packages/donatj/mddoc)
[![License](https://poser.pugx.org/donatj/mddoc/license)](https://packagist.org/packages/donatj/mddoc)


A simple, directed phpDoc => Markdown generator.

This is a work in progress and not ready for use.

This projects goal is to be able to define a set of directions for *how* to document a set of PHP files as well as markdown and other text to include, and output the final documentation in a jekyll or other markdown site builder ready form.


## Documentation Example (WIP)

### Class: \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface

#### Method: AutoloaderInterface->__invoke

```php
function __invoke($className)
```

##### Parameters:

- ***mixed*** `$className`

##### Returns:

- ***string*** | ***null***

### Class: \donatj\MDDoc\Autoloaders\NullLoader

#### Method: NullLoader->__invoke

```php
function __invoke($className)
```

##### Parameters:

- ***mixed*** `$className`

##### Returns:

- ***string*** | ***null***

### Class: \donatj\MDDoc\Autoloaders\Psr0

Class Psr0

#### Method: Psr0->__construct

```php
function __construct(\donatj\MDDoc\Autoloaders\string $path)
```

##### Parameters:

- ***string*** `$path` - Root path

---

#### Method: Psr0->__invoke

```php
function __invoke($class)
```

##### Parameters:

- ***mixed*** `$class`

##### Returns:

- ***bool*** | ***string***

### Class: \donatj\MDDoc\Autoloaders\Psr4

Class Psr4

#### Method: Psr4->__construct

```php
function __construct(\donatj\MDDoc\Autoloaders\string $root_namespace, \donatj\MDDoc\Autoloaders\string $path)
```

##### Parameters:

- ***string*** `$root_namespace` - Namespace prefix
- ***string*** `$path` - Root path

---

#### Method: Psr4->__invoke

```php
function __invoke($class)
```

##### Parameters:

- ***mixed*** `$class`

##### Returns:

- ***bool*** | ***null***



### Class: \donatj\MDDoc\Documentation\AbstractNestedDoc

#### Method: AbstractNestedDoc->getChildren

```php
function getChildren()
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



#### Undocumented Method: `AbstractNestedDoc->addChild(\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface $child)`

### Class: \donatj\MDDoc\Documentation\Badges\Badge

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class Badge {
	const OPT_ALT = 'alt';
	const OPT_SRC = 'src';
	const OPT_HREF = 'href';
	const OPT_TITLE = 'title';
}
```



#### Undocumented Method: `Badge->output(\donatj\MDDoc\Documentation\Badges\int $depth)`

### Class: \donatj\MDDoc\Documentation\Badges\BadgePoser

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgePoser {
	const URL_POSER_BASE = 'https://poser.pugx.org/';
	const URL_PACKAGIST_BASE = 'https://packagist.org/packages/';
	const OPT_SUFFIX = 'suffix';
}
```

### Class: \donatj\MDDoc\Documentation\Badges\BadgeScrutinizer

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeScrutinizer {
	const URL_SCRUTINIZER_BASE = 'https://scrutinizer-ci.com/g/';
	const OPT_SUFFIX = 'suffix';
	const OPT_BRANCH = 'branch';
}
```

### Class: \donatj\MDDoc\Documentation\Badges\BadgeTravis

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeTravis {
	const URL_TRAVIS_BASE = 'https://travis-ci.org/';
	const OPT_BRANCH = 'branch';
}
```

### Class: \donatj\MDDoc\Documentation\ClassFile



#### Undocumented Method: `ClassFile->output(\donatj\MDDoc\Documentation\int $depth)`



#### Undocumented Method: `ClassFile->setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader)`

### Class: \donatj\MDDoc\Documentation\ComposerInstall



#### Undocumented Method: `ComposerInstall->output(\donatj\MDDoc\Documentation\int $depth)`

### Class: \donatj\MDDoc\Documentation\ComposerRequires



#### Undocumented Method: `ComposerRequires->output(\donatj\MDDoc\Documentation\int $depth)`

### Class: \donatj\MDDoc\Documentation\DocPage



#### Undocumented Method: `DocPage->output(\donatj\MDDoc\Documentation\int $depth)`

### Class: \donatj\MDDoc\Documentation\DocRoot



#### Undocumented Method: `DocRoot->output(\donatj\MDDoc\Documentation\int $depth)`

### Class: \donatj\MDDoc\Documentation\Exceptions\ExecutionException

### Class: \donatj\MDDoc\Documentation\ExecOutput

```php
<?php
namespace donatj\MDDoc\Documentation;

class ExecOutput {
	const FORMAT_DEFAULT = 'default';
	const FORMAT_RAW = 'raw';
	const FORMAT_CODE = 'code';
	const FORMAT_CODE_BLOCK = 'code-block';
}
```

#### Method: ExecOutput->output

```php
function output(\donatj\MDDoc\Documentation\int $depth)
```

##### Returns:

- ***\donatj\MDDom\Code*** | ***\donatj\MDDom\CodeBlock*** | ***\donatj\MDDom\Paragraph*** | ***string***

### Class: \donatj\MDDoc\Documentation\IncludeFile

#### Method: IncludeFile->output

```php
function output(\donatj\MDDoc\Documentation\int $depth)
```

##### Returns:

- ***\donatj\MDDom\Paragraph***

### Class: \donatj\MDDoc\Documentation\Interfaces\AutoloaderAware



#### Undocumented Method: `AutoloaderAware->setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader)`

### Class: \donatj\MDDoc\Documentation\Interfaces\DocumentationInterface



#### Undocumented Method: `DocumentationInterface->__construct(array $options, array $tree_options)`

---

#### Method: DocumentationInterface->output

```php
function output(\donatj\MDDoc\Documentation\Interfaces\int $depth)
```

##### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

### Class: \donatj\MDDoc\Documentation\RecursiveDirectory



#### Undocumented Method: `RecursiveDirectory->setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader)`



#### Undocumented Method: `RecursiveDirectory->output(\donatj\MDDoc\Documentation\int $depth)`

### Class: \donatj\MDDoc\Documentation\Section



#### Undocumented Method: `Section->output(\donatj\MDDoc\Documentation\int $depth)`

### Class: \donatj\MDDoc\Documentation\Source

Class Source

#### Method: Source->output

```php
function output(\donatj\MDDoc\Documentation\int $depth)
```

##### Returns:

- ***string***

### Class: \donatj\MDDoc\Documentation\Text

Class Text



#### Undocumented Method: `Text->__construct(array $options, array $tree_options [, $text = ''])`



#### Undocumented Method: `Text->output(\donatj\MDDoc\Documentation\int $depth)`

### Class: \donatj\MDDoc\Exceptions\ClassNotReadableException

### Class: \donatj\MDDoc\Exceptions\ConfigException

### Class: \donatj\MDDoc\Exceptions\MDDocException

### Class: \donatj\MDDoc\Exceptions\PathNotReadableException



#### Undocumented Method: `PathNotReadableException->__construct($message, $path [, \Exception $previous_exception = null])`



#### Undocumented Method: `PathNotReadableException->getPath()`

### Class: \donatj\MDDoc\Exceptions\TargetNotWritableException

### Class: \donatj\MDDoc\MDDoc

Application MDDoc

```php
<?php
namespace donatj\MDDoc;

class MDDoc {
	const VERSION = "0.0.1a";
	const CONFIG_FILE = "mddoc.xml";
	const CONFIG_FILE_ALT = ".mddoc.xml";
}
```



#### Undocumented Method: `MDDoc->__construct(array $args)`

### Class: \donatj\MDDoc\Reflectors\TaxonomyReflector

#### Method: TaxonomyReflector->__construct

```php
function __construct(\donatj\MDDoc\Reflectors\string $filename, \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader, \donatj\MDDoc\Reflectors\TaxonomyReflectorFactory $parserFactory)
```



#### Undocumented Method: `TaxonomyReflector->getData()`

---

#### Method: TaxonomyReflector->getReflector

```php
function getReflector()
```

##### Returns:

- ***\phpDocumentor\Reflection\InterfaceReflector*** | ***null***

---

#### Method: TaxonomyReflector->getMethods

```php
function getMethods()
```

##### Returns:

- ***\phpDocumentor\Reflection\ClassReflector\MethodReflector[][]***

---

#### Method: TaxonomyReflector->getConstants

```php
function getConstants()
```

##### Returns:

- ***\phpDocumentor\Reflection\ClassReflector\ConstantReflector[][]***

---

#### Method: TaxonomyReflector->getProperties

```php
function getProperties()
```

##### Returns:

- ***\phpDocumentor\Reflection\ClassReflector\PropertyReflector[][]***

### Class: \donatj\MDDoc\Reflectors\TaxonomyReflectorFactory

#### Method: TaxonomyReflectorFactory->newInstance

```php
function newInstance($filename, \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader)
```

##### Parameters:

- ***mixed*** `$filename` - string

##### Returns:

- ***\donatj\MDDoc\Reflectors\TaxonomyReflector***

### Class: \donatj\MDDoc\Runner\ConfigParser

#### Method: ConfigParser->parse

```php
function parse($filename)
```

Parse a config file

##### Parameters:

- ***string*** `$filename`

##### Returns:

- ***\donatj\MDDoc\Documentation\DocRoot***

### Class: \donatj\MDDoc\Runner\UserInterface



#### Undocumented Method: `UserInterface->__construct($STDOUT, $STDERR)`



#### Undocumented Method: `UserInterface->dumpOptions($additional)`



#### Undocumented Method: `UserInterface->dropError($text [, $code = 1 [, $additional = false]])`



#### Undocumented Method: `UserInterface->outputMsg($text)`