# MDDoc

A simple, directed phpDoc => Markdown generator.

This is a work in progress and not ready for use.

This projects goal is to be able to define a set of directions for *how* to document a set of PHP files as well as markdown and other text to include, and output the final documentation in a jekyll or other markdown site builder ready form.


## Documentation Example (WIP)

### Class: AutoloaderInterface \[ `\donatj\MDDoc\Autoloaders\Interfaces` \]

#### Method: `AutoloaderInterface->__invoke($className)`

##### Parameters:

- ***mixed*** `$className`

##### Returns:

- ***string*** | ***null***

### Class: NullLoader \[ `\donatj\MDDoc\Autoloaders` \]

#### Method: `NullLoader->__invoke($className)`

##### Parameters:

- ***mixed*** `$className`

##### Returns:

- ***string*** | ***null***

### Class: Psr0 \[ `\donatj\MDDoc\Autoloaders` \]

Class Psr0

#### Method: `Psr0->__construct($path)`

##### Parameters:

- ***string*** `$path` - Root path

---

#### Method: `Psr0->__invoke($class)`

##### Parameters:

- ***mixed*** `$class`

##### Returns:

- ***bool*** | ***string***

### Class: Psr4 \[ `\donatj\MDDoc\Autoloaders` \]

Class Psr4

#### Method: `Psr4->__construct($root_namespace, $path)`

##### Parameters:

- ***string*** `$root_namespace` - Namespace prefix
- ***string*** `$path` - Root path

---

#### Method: `Psr4->__invoke($class)`

##### Parameters:

- ***mixed*** `$class`

##### Returns:

- ***bool*** | ***null***

### Class: AbstractDocPart \[ `\donatj\MDDoc\Documentation` \]



#### Undocumented Method: `AbstractDocPart->__construct($options, $tree_options)`



#### Undocumented Method: `AbstractDocPart->setOptions($options, $tree_options)`

---

#### Method: `AbstractDocPart->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `AbstractDocPart->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `AbstractDocPart->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `AbstractDocPart->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

---

#### Method: `AbstractDocPart->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

### Class: AbstractNestedDoc \[ `\donatj\MDDoc\Documentation` \]

#### Method: `AbstractNestedDoc->getChildren()`

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

#### Method: `AbstractNestedDoc->setChildren($children)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`

---

#### Method: `AbstractNestedDoc->addChild($child)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `AbstractNestedDoc->__construct($options, $tree_options)`



#### Undocumented Method: `AbstractNestedDoc->setOptions($options, $tree_options)`

---

#### Method: `AbstractNestedDoc->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `AbstractNestedDoc->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `AbstractNestedDoc->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `AbstractNestedDoc->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

---

#### Method: `AbstractNestedDoc->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

### Class: Badge \[ `\donatj\MDDoc\Documentation\Badges` \]

#### Method: `Badge->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `Badge->__construct($options, $tree_options)`



#### Undocumented Method: `Badge->setOptions($options, $tree_options)`

---

#### Method: `Badge->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `Badge->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `Badge->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `Badge->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: BadgePoser \[ `\donatj\MDDoc\Documentation\Badges` \]

#### Method: `BadgePoser->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `BadgePoser->__construct($options, $tree_options)`



#### Undocumented Method: `BadgePoser->setOptions($options, $tree_options)`

---

#### Method: `BadgePoser->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `BadgePoser->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `BadgePoser->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `BadgePoser->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: BadgeTravis \[ `\donatj\MDDoc\Documentation\Badges` \]

#### Method: `BadgeTravis->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `BadgeTravis->__construct($options, $tree_options)`



#### Undocumented Method: `BadgeTravis->setOptions($options, $tree_options)`

---

#### Method: `BadgeTravis->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `BadgeTravis->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `BadgeTravis->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `BadgeTravis->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: ClassFile \[ `\donatj\MDDoc\Documentation` \]

#### Method: `ClassFile->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `ClassFile->setAutoloader($autoloader)`



#### Undocumented Method: `ClassFile->__construct($options, $tree_options)`



#### Undocumented Method: `ClassFile->setOptions($options, $tree_options)`

---

#### Method: `ClassFile->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `ClassFile->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `ClassFile->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `ClassFile->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: ComposerInstall \[ `\donatj\MDDoc\Documentation` \]

#### Method: `ComposerInstall->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `ComposerInstall->__construct($options, $tree_options)`



#### Undocumented Method: `ComposerInstall->setOptions($options, $tree_options)`

---

#### Method: `ComposerInstall->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `ComposerInstall->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `ComposerInstall->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `ComposerInstall->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: ComposerRequires \[ `\donatj\MDDoc\Documentation` \]

#### Method: `ComposerRequires->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `ComposerRequires->__construct($options, $tree_options)`



#### Undocumented Method: `ComposerRequires->setOptions($options, $tree_options)`

---

#### Method: `ComposerRequires->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `ComposerRequires->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `ComposerRequires->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `ComposerRequires->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: DocPage \[ `\donatj\MDDoc\Documentation` \]

#### Method: `DocPage->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

---

#### Method: `DocPage->getChildren()`

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

#### Method: `DocPage->setChildren($children)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`

---

#### Method: `DocPage->addChild($child)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `DocPage->__construct($options, $tree_options)`



#### Undocumented Method: `DocPage->setOptions($options, $tree_options)`

---

#### Method: `DocPage->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `DocPage->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `DocPage->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `DocPage->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: DocRoot \[ `\donatj\MDDoc\Documentation` \]

#### Method: `DocRoot->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

---

#### Method: `DocRoot->getChildren()`

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

#### Method: `DocRoot->setChildren($children)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`

---

#### Method: `DocRoot->addChild($child)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `DocRoot->__construct($options, $tree_options)`



#### Undocumented Method: `DocRoot->setOptions($options, $tree_options)`

---

#### Method: `DocRoot->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `DocRoot->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `DocRoot->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `DocRoot->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: IncludeFile \[ `\donatj\MDDoc\Documentation` \]

#### Method: `IncludeFile->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***\donatj\MDDom\Paragraph***



#### Undocumented Method: `IncludeFile->__construct($options, $tree_options)`



#### Undocumented Method: `IncludeFile->setOptions($options, $tree_options)`

---

#### Method: `IncludeFile->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `IncludeFile->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `IncludeFile->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `IncludeFile->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: AutoloaderAware \[ `\donatj\MDDoc\Documentation\Interfaces` \]



#### Undocumented Method: `AutoloaderAware->setAutoloader($autoloader)`

### Class: DocumentationInterface \[ `\donatj\MDDoc\Documentation\Interfaces` \]



#### Undocumented Method: `DocumentationInterface->__construct($options, $tree_options)`

---

#### Method: `DocumentationInterface->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

### Class: RecursiveDirectory \[ `\donatj\MDDoc\Documentation` \]



#### Undocumented Method: `RecursiveDirectory->setAutoloader($autoloader)`

---

#### Method: `RecursiveDirectory->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

---

#### Method: `RecursiveDirectory->getChildren()`

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

#### Method: `RecursiveDirectory->setChildren($children)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`

---

#### Method: `RecursiveDirectory->addChild($child)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `RecursiveDirectory->__construct($options, $tree_options)`



#### Undocumented Method: `RecursiveDirectory->setOptions($options, $tree_options)`

---

#### Method: `RecursiveDirectory->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `RecursiveDirectory->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `RecursiveDirectory->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `RecursiveDirectory->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: Section \[ `\donatj\MDDoc\Documentation` \]

#### Method: `Section->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***

---

#### Method: `Section->getChildren()`

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

#### Method: `Section->setChildren($children)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`

---

#### Method: `Section->addChild($child)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `Section->__construct($options, $tree_options)`



#### Undocumented Method: `Section->setOptions($options, $tree_options)`

---

#### Method: `Section->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `Section->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `Section->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `Section->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: Source \[ `\donatj\MDDoc\Documentation` \]

Class Source

#### Method: `Source->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `Source->__construct($options, $tree_options [, $text = ''])`



#### Undocumented Method: `Source->setOptions($options, $tree_options)`

---

#### Method: `Source->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `Source->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `Source->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `Source->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: Text \[ `\donatj\MDDoc\Documentation` \]

Class Text



#### Undocumented Method: `Text->__construct($options, $tree_options [, $text = ''])`

---

#### Method: `Text->output($depth)`

##### Parameters:

- ***int*** `$depth`

##### Returns:

- ***string***



#### Undocumented Method: `Text->setOptions($options, $tree_options)`

---

#### Method: `Text->setOptionDefault($key, $value)`

##### Parameters:

- ***mixed*** `$key` - string
- ***mixed*** `$value` - mixed

---

#### Method: `Text->getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`

##### Returns:

- ***null*** | ***string***

---

#### Method: `Text->setParent($parent)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** `$parent`

---

#### Method: `Text->getParent()`

##### Returns:

- ***\donatj\MDDoc\Documentation\AbstractDocPart*** | ***null***

### Class: ClassNotReadableException \[ `\donatj\MDDoc\Exceptions` \]



#### Undocumented Method: `ClassNotReadableException->__construct($message, $path [, $previous_exception = null])`

---

#### Method: `ClassNotReadableException->getPath()`

##### Returns:

- ***mixed***

### Class: ConfigException \[ `\donatj\MDDoc\Exceptions` \]

### Class: PathNotReadableException \[ `\donatj\MDDoc\Exceptions` \]



#### Undocumented Method: `PathNotReadableException->__construct($message, $path [, $previous_exception = null])`

---

#### Method: `PathNotReadableException->getPath()`

##### Returns:

- ***mixed***

### Class: TargetNotWritableException \[ `\donatj\MDDoc\Exceptions` \]

### Class: MDDoc \[ `\donatj\MDDoc` \]

Application MDDoc



#### Undocumented Method: `MDDoc->__construct($args)`

### Class: TaxonomyReflector \[ `\donatj\MDDoc\Reflectors` \]

#### Method: `TaxonomyReflector->__construct($filename, $autoLoader, $parserFactory)`

##### Parameters:

- ***string*** `$filename`
- ***\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface*** `$autoLoader`
- ***\donatj\MDDoc\Reflectors\TaxonomyReflectorFactory*** `$parserFactory`

---

#### Method: `TaxonomyReflector->getData()`

##### Returns:

- ***mixed***

---

#### Method: `TaxonomyReflector->getReflector()`

##### Returns:

- ***null*** | ***\phpDocumentor\Reflection\InterfaceReflector***

---

#### Method: `TaxonomyReflector->getMethods()`

##### Returns:

- ***\phpDocumentor\Reflection\ClassReflector\MethodReflector[][]***

### Class: TaxonomyReflectorFactory \[ `\donatj\MDDoc\Reflectors` \]

#### Method: `TaxonomyReflectorFactory->newInstance($filename, $autoLoader)`

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