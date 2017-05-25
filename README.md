# MDDoc

A simple, directed phpDoc => Markdown generator.

This is a work in progress and not ready for use.

This projects goal is to be able to define a set of directions for *how* to document a set of PHP files as well as markdown and other text to include, and output the final documentation in a jekyll or other markdown site builder ready form.


## Documentation Example (WIP)

### Class: AutoloaderInterface \[ `\donatj\MDDoc\Autoloaders\Interfaces` \]

#### Method: `AutoloaderInterface->__invoke`

```php
function __invoke($className)
```

##### Parameters:

- ***mixed*** `$className`

##### Returns:

- ***string*** | ***null***

### Class: NullLoader \[ `\donatj\MDDoc\Autoloaders` \]

#### Method: `NullLoader->__invoke`

```php
function __invoke($className)
```

##### Parameters:

- ***mixed*** `$className`

##### Returns:

- ***string*** | ***null***

### Class: Psr0 \[ `\donatj\MDDoc\Autoloaders` \]

Class Psr0

#### Method: `Psr0->__construct`

```php
function __construct($path)
```

##### Parameters:

- ***string*** `$path` - Root path

---

#### Method: `Psr0->__invoke`

```php
function __invoke($class)
```

##### Parameters:

- ***mixed*** `$class`

##### Returns:

- ***bool*** | ***string***

### Class: Psr4 \[ `\donatj\MDDoc\Autoloaders` \]

Class Psr4

#### Method: `Psr4->__construct`

```php
function __construct($root_namespace, $path)
```

##### Parameters:

- ***string*** `$root_namespace` - Namespace prefix
- ***string*** `$path` - Root path

---

#### Method: `Psr4->__invoke`

```php
function __invoke($class)
```

##### Parameters:

- ***mixed*** `$class`

##### Returns:

- ***bool*** | ***null***

### Class: AbstractDocPart \[ `\donatj\MDDoc\Documentation` \]



#### Undocumented Method: `AbstractDocPart->__construct($options, $tree_options)`



#### Undocumented Method: `AbstractDocPart->setOptions($options, $tree_options)`

---

#### Method: `AbstractDocPart->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `AbstractDocPart->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `AbstractDocPart->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `AbstractDocPart->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

---

#### Method: `AbstractDocPart->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

### Class: AbstractNestedDoc \[ `\donatj\MDDoc\Documentation` \]

#### Method: `AbstractNestedDoc->getChildren`

```php
function getChildren()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

#### Method: `AbstractNestedDoc->setChildren`

```php
function setChildren($children)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`

---

#### Method: `AbstractNestedDoc->addChild`

```php
function addChild($child)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `AbstractNestedDoc->__construct($options, $tree_options)`



#### Undocumented Method: `AbstractNestedDoc->setOptions($options, $tree_options)`

---

#### Method: `AbstractNestedDoc->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `AbstractNestedDoc->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `AbstractNestedDoc->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `AbstractNestedDoc->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

---

#### Method: `AbstractNestedDoc->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

### Class: Badge \[ `\donatj\MDDoc\Documentation\Badges` \]

#### Method: `Badge->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `Badge->__construct($options, $tree_options)`



#### Undocumented Method: `Badge->setOptions($options, $tree_options)`

---

#### Method: `Badge->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `Badge->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `Badge->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `Badge->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: BadgePoser \[ `\donatj\MDDoc\Documentation\Badges` \]

#### Method: `BadgePoser->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `BadgePoser->__construct($options, $tree_options)`



#### Undocumented Method: `BadgePoser->setOptions($options, $tree_options)`

---

#### Method: `BadgePoser->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `BadgePoser->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `BadgePoser->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `BadgePoser->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: BadgeScrutinizer \[ `\donatj\MDDoc\Documentation\Badges` \]

#### Method: `BadgeScrutinizer->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `BadgeScrutinizer->__construct($options, $tree_options)`



#### Undocumented Method: `BadgeScrutinizer->setOptions($options, $tree_options)`

---

#### Method: `BadgeScrutinizer->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `BadgeScrutinizer->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `BadgeScrutinizer->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `BadgeScrutinizer->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: BadgeTravis \[ `\donatj\MDDoc\Documentation\Badges` \]

#### Method: `BadgeTravis->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `BadgeTravis->__construct($options, $tree_options)`



#### Undocumented Method: `BadgeTravis->setOptions($options, $tree_options)`

---

#### Method: `BadgeTravis->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `BadgeTravis->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `BadgeTravis->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `BadgeTravis->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: ClassFile \[ `\donatj\MDDoc\Documentation` \]

#### Method: `ClassFile->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `ClassFile->setAutoloader($autoloader)`



#### Undocumented Method: `ClassFile->__construct($options, $tree_options)`



#### Undocumented Method: `ClassFile->setOptions($options, $tree_options)`

---

#### Method: `ClassFile->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `ClassFile->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `ClassFile->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `ClassFile->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: ComposerInstall \[ `\donatj\MDDoc\Documentation` \]

#### Method: `ComposerInstall->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `ComposerInstall->__construct($options, $tree_options)`



#### Undocumented Method: `ComposerInstall->setOptions($options, $tree_options)`

---

#### Method: `ComposerInstall->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `ComposerInstall->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `ComposerInstall->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `ComposerInstall->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: ComposerRequires \[ `\donatj\MDDoc\Documentation` \]

#### Method: `ComposerRequires->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `ComposerRequires->__construct($options, $tree_options)`



#### Undocumented Method: `ComposerRequires->setOptions($options, $tree_options)`

---

#### Method: `ComposerRequires->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `ComposerRequires->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `ComposerRequires->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `ComposerRequires->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: DocPage \[ `\donatj\MDDoc\Documentation` \]

#### Method: `DocPage->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

---

#### Method: `DocPage->getChildren`

```php
function getChildren()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

#### Method: `DocPage->setChildren`

```php
function setChildren($children)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`

---

#### Method: `DocPage->addChild`

```php
function addChild($child)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `DocPage->__construct($options, $tree_options)`



#### Undocumented Method: `DocPage->setOptions($options, $tree_options)`

---

#### Method: `DocPage->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `DocPage->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `DocPage->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `DocPage->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: DocRoot \[ `\donatj\MDDoc\Documentation` \]

#### Method: `DocRoot->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

---

#### Method: `DocRoot->getChildren`

```php
function getChildren()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

#### Method: `DocRoot->setChildren`

```php
function setChildren($children)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`

---

#### Method: `DocRoot->addChild`

```php
function addChild($child)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `DocRoot->__construct($options, $tree_options)`



#### Undocumented Method: `DocRoot->setOptions($options, $tree_options)`

---

#### Method: `DocRoot->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `DocRoot->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `DocRoot->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `DocRoot->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: IncludeFile \[ `\donatj\MDDoc\Documentation` \]

#### Method: `IncludeFile->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***\donatj\MDDom\Paragraph***



#### Undocumented Method: `IncludeFile->__construct($options, $tree_options)`



#### Undocumented Method: `IncludeFile->setOptions($options, $tree_options)`

---

#### Method: `IncludeFile->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `IncludeFile->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `IncludeFile->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `IncludeFile->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: AutoloaderAware \[ `\donatj\MDDoc\Documentation\Interfaces` \]



#### Undocumented Method: `AutoloaderAware->setAutoloader($autoloader)`

### Class: DocumentationInterface \[ `\donatj\MDDoc\Documentation\Interfaces` \]



#### Undocumented Method: `DocumentationInterface->__construct($options, $tree_options)`

---

#### Method: `DocumentationInterface->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

### Class: RecursiveDirectory \[ `\donatj\MDDoc\Documentation` \]



#### Undocumented Method: `RecursiveDirectory->setAutoloader($autoloader)`

---

#### Method: `RecursiveDirectory->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

---

#### Method: `RecursiveDirectory->getChildren`

```php
function getChildren()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

#### Method: `RecursiveDirectory->setChildren`

```php
function setChildren($children)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`

---

#### Method: `RecursiveDirectory->addChild`

```php
function addChild($child)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `RecursiveDirectory->__construct($options, $tree_options)`



#### Undocumented Method: `RecursiveDirectory->setOptions($options, $tree_options)`

---

#### Method: `RecursiveDirectory->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `RecursiveDirectory->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `RecursiveDirectory->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `RecursiveDirectory->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: Section \[ `\donatj\MDDoc\Documentation` \]

#### Method: `Section->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

---

#### Method: `Section->getChildren`

```php
function getChildren()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

#### Method: `Section->setChildren`

```php
function setChildren($children)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`

---

#### Method: `Section->addChild`

```php
function addChild($child)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `Section->__construct($options, $tree_options)`



#### Undocumented Method: `Section->setOptions($options, $tree_options)`

---

#### Method: `Section->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `Section->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `Section->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `Section->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: Source \[ `\donatj\MDDoc\Documentation` \]

Class Source

#### Method: `Source->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `Source->__construct($options, $tree_options [, $text = ''])`



#### Undocumented Method: `Source->setOptions($options, $tree_options)`

---

#### Method: `Source->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `Source->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `Source->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `Source->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: Text \[ `\donatj\MDDoc\Documentation` \]

Class Text



#### Undocumented Method: `Text->__construct($options, $tree_options [, $text = ''])`

---

#### Method: `Text->output`

```php
function output($depth)
```

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `Text->setOptions($options, $tree_options)`

---

#### Method: `Text->setOptionDefault`

```php
function setOptionDefault($key, $value)
```

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `Text->getOption`

```php
function getOption($key [, $tree = false])
```

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `Text->setParent`

```php
function setParent($parent)
```

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `Text->getParent`

```php
function getParent()
```

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: ClassNotReadableException \[ `\donatj\MDDoc\Exceptions` \]



#### Undocumented Method: `ClassNotReadableException->__construct($message, $path [, $previous_exception = null])`

---

#### Method: `ClassNotReadableException->getPath`

```php
function getPath()
```

##### Returns:

- ***mixed***

### Class: ConfigException \[ `\donatj\MDDoc\Exceptions` \]

### Class: PathNotReadableException \[ `\donatj\MDDoc\Exceptions` \]



#### Undocumented Method: `PathNotReadableException->__construct($message, $path [, $previous_exception = null])`

---

#### Method: `PathNotReadableException->getPath`

```php
function getPath()
```

##### Returns:

- ***mixed***

### Class: TargetNotWritableException \[ `\donatj\MDDoc\Exceptions` \]

### Class: MDDoc \[ `\donatj\MDDoc` \]

Application MDDoc



#### Undocumented Method: `MDDoc->__construct($args)`

### Class: TaxonomyReflector \[ `\donatj\MDDoc\Reflectors` \]

#### Method: `TaxonomyReflector->__construct`

```php
function __construct($filename, $autoLoader, $parserFactory)
```

##### Parameters:

- ***string*** `$filename`
- ***\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface*** `$autoLoader`
- ***\donatj\MDDoc\Reflectors\TaxonomyReflectorFactory*** `$parserFactory`

---

#### Method: `TaxonomyReflector->getData`

```php
function getData()
```

##### Returns:

- ***mixed***

---

#### Method: `TaxonomyReflector->getReflector`

```php
function getReflector()
```

##### Returns:

- ***null*** | ***\phpDocumentor\Reflection\InterfaceReflector***

---

#### Method: `TaxonomyReflector->getMethods`

```php
function getMethods()
```

##### Returns:

- ***\phpDocumentor\Reflection\ClassReflector\MethodReflector[][]***

### Class: TaxonomyReflectorFactory \[ `\donatj\MDDoc\Reflectors` \]

#### Method: `TaxonomyReflectorFactory->newInstance`

```php
function newInstance($filename, $autoLoader)
```

##### Parameters:

- ***mixed*** `$filename`
- ***\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface*** `$autoLoader`

##### Returns:

- ***\donatj\MDDoc\Reflectors\TaxonomyReflector***

### Class: ConfigParser \[ `\donatj\MDDoc\Runner` \]



#### Undocumented Method: `ConfigParser->__construct($filename)`

### Class: UserInterface \[ `\donatj\MDDoc\Runner` \]



#### Undocumented Method: `UserInterface->__construct($STDOUT, $STDERR)`



#### Undocumented Method: `UserInterface->dumpOptions($additional)`



#### Undocumented Method: `UserInterface->dropError($text [, $code = 1 [, $additional = false]])`



#### Undocumented Method: `UserInterface->outputMsg($text)`