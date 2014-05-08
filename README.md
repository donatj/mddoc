# MDDoc

A simple, directed phpDoc => Markdown generator.

This is a work in progress and not ready for use.

This projects goal is to be able to define a set of directions for *how* to document a set of PHP files as well as markdown and other text to include, and output the final documentation in a jekyll or other markdown site builder ready form.

## Documentation Example (WIP)



### Class: AutoloaderInterface \[ `\donatj\MDDoc\Autoloaders\Interfaces` \]

#### Method: `AutoloaderInterface`->`__invoke($className)`

##### Parameters:

- ***mixed*** `$className`


##### Returns:

- ***string*** | ***null***

### Class: Mock \[ `\donatj\MDDoc\Autoloaders` \]

#### Method: `Mock`->`__invoke($className)`

##### Parameters:

- ***mixed*** `$className`


##### Returns:

- ***string*** | ***null***

### Class: Psr0 \[ `\donatj\MDDoc\Autoloaders` \]

Class Psr0

#### Method: `Psr0`->`__construct($path)`

##### Parameters:

- ***string*** `$path` - Root path



---

#### Method: `Psr0`->`__invoke($class)`

##### Parameters:

- ***mixed*** `$class`


##### Returns:

- ***bool*** | ***string***

### Class: Psr4 \[ `\donatj\MDDoc\Autoloaders` \]

Class Psr4

#### Method: `Psr4`->`__construct($root_namespace, $path)`

##### Parameters:

- ***string*** `$root_namespace` - Namespace prefix
- ***string*** `$path` - Root path



---

#### Method: `Psr4`->`__invoke($class)`

##### Parameters:

- ***mixed*** `$class`


##### Returns:

- ***bool*** | ***null***

### Class: AbstractDocPart \[ `\donatj\MDDoc\Documentation` \]

#### Undocumented Method: `AbstractDocPart`->`__construct($options, $tree_options)`
#### Undocumented Method: `AbstractDocPart`->`setOptions($options, $tree_options)`
---

#### Method: `AbstractDocPart`->`getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`


##### Returns:

- ***null*** | ***string***


---

#### Method: `AbstractDocPart`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***

### Class: AbstractNestedDoc \[ `\donatj\MDDoc\Documentation` \]

#### Method: `AbstractNestedDoc`->`getChildren()`

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***


---

#### Method: `AbstractNestedDoc`->`setChildren($children)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`



---

#### Method: `AbstractNestedDoc`->`addChild($child)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `AbstractNestedDoc`->`__construct($options, $tree_options)`
#### Undocumented Method: `AbstractNestedDoc`->`setOptions($options, $tree_options)`
---

#### Method: `AbstractNestedDoc`->`getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`


##### Returns:

- ***null*** | ***string***


---

#### Method: `AbstractNestedDoc`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***

### Class: ClassFile \[ `\donatj\MDDoc\Documentation` \]

#### Method: `ClassFile`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***


#### Undocumented Method: `ClassFile`->`setAutoloader($autoloader)`
#### Undocumented Method: `ClassFile`->`__construct($options, $tree_options)`
#### Undocumented Method: `ClassFile`->`setOptions($options, $tree_options)`
---

#### Method: `ClassFile`->`getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`


##### Returns:

- ***null*** | ***string***

### Class: DocPage \[ `\donatj\MDDoc\Documentation` \]

#### Method: `DocPage`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***


---

#### Method: `DocPage`->`getChildren()`

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***


---

#### Method: `DocPage`->`setChildren($children)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`



---

#### Method: `DocPage`->`addChild($child)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `DocPage`->`__construct($options, $tree_options)`
#### Undocumented Method: `DocPage`->`setOptions($options, $tree_options)`
---

#### Method: `DocPage`->`getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`


##### Returns:

- ***null*** | ***string***

### Class: DocRoot \[ `\donatj\MDDoc\Documentation` \]

#### Method: `DocRoot`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***


---

#### Method: `DocRoot`->`getChildren()`

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***


---

#### Method: `DocRoot`->`setChildren($children)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`



---

#### Method: `DocRoot`->`addChild($child)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `DocRoot`->`__construct($options, $tree_options)`
#### Undocumented Method: `DocRoot`->`setOptions($options, $tree_options)`
---

#### Method: `DocRoot`->`getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`


##### Returns:

- ***null*** | ***string***

### Class: IncludeFile \[ `\donatj\MDDoc\Documentation` \]

#### Method: `IncludeFile`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***


#### Undocumented Method: `IncludeFile`->`__construct($options, $tree_options)`
#### Undocumented Method: `IncludeFile`->`setOptions($options, $tree_options)`
---

#### Method: `IncludeFile`->`getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`


##### Returns:

- ***null*** | ***string***

### Class: AutoloaderAware \[ `\donatj\MDDoc\Documentation\Interfaces` \]

#### Undocumented Method: `AutoloaderAware`->`setAutoloader($autoloader)`

### Class: DocumentationInterface \[ `\donatj\MDDoc\Documentation\Interfaces` \]

#### Undocumented Method: `DocumentationInterface`->`__construct($options, $tree_options)`
---

#### Method: `DocumentationInterface`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***

### Class: RecursiveDirectory \[ `\donatj\MDDoc\Documentation` \]

#### Undocumented Method: `RecursiveDirectory`->`setAutoloader($autoloader)`
---

#### Method: `RecursiveDirectory`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***


---

#### Method: `RecursiveDirectory`->`getChildren()`

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***


---

#### Method: `RecursiveDirectory`->`setChildren($children)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`



---

#### Method: `RecursiveDirectory`->`addChild($child)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `RecursiveDirectory`->`__construct($options, $tree_options)`
#### Undocumented Method: `RecursiveDirectory`->`setOptions($options, $tree_options)`
---

#### Method: `RecursiveDirectory`->`getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`


##### Returns:

- ***null*** | ***string***

### Class: Section \[ `\donatj\MDDoc\Documentation` \]

#### Method: `Section`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***


---

#### Method: `Section`->`getChildren()`

##### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***


---

#### Method: `Section`->`setChildren($children)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`



---

#### Method: `Section`->`addChild($child)`

##### Parameters:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



#### Undocumented Method: `Section`->`__construct($options, $tree_options)`
#### Undocumented Method: `Section`->`setOptions($options, $tree_options)`
---

#### Method: `Section`->`getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`


##### Returns:

- ***null*** | ***string***

### Class: Source \[ `\donatj\MDDoc\Documentation` \]

Class Source

#### Method: `Source`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***


#### Undocumented Method: `Source`->`__construct($options, $tree_options [, $text = ''])`
#### Undocumented Method: `Source`->`setOptions($options, $tree_options)`
---

#### Method: `Source`->`getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`


##### Returns:

- ***null*** | ***string***

### Class: Text \[ `\donatj\MDDoc\Documentation` \]

Class Text

#### Undocumented Method: `Text`->`__construct($options, $tree_options [, $text = ''])`
---

#### Method: `Text`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***


#### Undocumented Method: `Text`->`setOptions($options, $tree_options)`
---

#### Method: `Text`->`getOption($key [, $tree = false])`

##### Parameters:

- ***string*** `$key`
- ***bool*** `$tree`


##### Returns:

- ***null*** | ***string***

### Class: ConfigException \[ `\donatj\MDDoc\Exceptions` \]

### Class: PathNotReadableException \[ `\donatj\MDDoc\Exceptions` \]

### Class: TargetNotWritableException \[ `\donatj\MDDoc\Exceptions` \]

### Class: MDDoc \[ `\donatj\MDDoc` \]

Application MDDoc

#### Undocumented Method: `MDDoc`->`__construct($args)`

### Class: TaxonomyReflector \[ `\donatj\MDDoc\Reflectors` \]

#### Method: `TaxonomyReflector`->`__construct($filename, $autoLoader, $parserFactory)`

##### Parameters:

- ***string*** `$filename`
- ***\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface*** `$autoLoader`
- ***\donatj\MDDoc\Reflectors\TaxonomyReflectorFactory*** `$parserFactory`



---

#### Method: `TaxonomyReflector`->`getData()`

##### Returns:

- ***mixed***


---

#### Method: `TaxonomyReflector`->`getReflector()`

##### Returns:

- ***null*** | ***\phpDocumentor\Reflection\InterfaceReflector***


---

#### Method: `TaxonomyReflector`->`getMethods()`

##### Returns:

- ***\phpDocumentor\Reflection\ClassReflector\MethodReflector[][]***

### Class: TaxonomyReflectorFactory \[ `\donatj\MDDoc\Reflectors` \]

#### Method: `TaxonomyReflectorFactory`->`newInstance($filename, $autoLoader)`

##### Parameters:

- ***mixed*** `$filename`
- ***\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface*** `$autoLoader`


##### Returns:

- ***\donatj\MDDoc\Reflectors\TaxonomyReflector***

### Class: ConfigParser \[ `\donatj\MDDoc\Runner` \]

#### Undocumented Method: `ConfigParser`->`__construct($filename)`

### Class: UserInterface \[ `\donatj\MDDoc\Runner` \]

#### Undocumented Method: `UserInterface`->`__construct($STDOUT, $STDERR)`
#### Undocumented Method: `UserInterface`->`dumpOptions($additional)`
#### Undocumented Method: `UserInterface`->`dropError($text [, $code = 1 [, $additional = false]])`
#### Undocumented Method: `UserInterface`->`outputMsg($text)`

Different Level

