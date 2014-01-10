# MDDoc

A simple, directed phpDoc => Markdown generator.

This is a work in progress and not ready for use.

This projects goal is to be able to define a set of directions for *how* to document a set of PHP files as well as markdown and other text to include, and output the final documentation in a jekyll or other markdown site builder ready form.

## Documentation Example (WIP)



### Class: AutoloaderInterface - `\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface`

#### Method: `AutoloaderInterface`::`makeAutoloader($root)`

##### Parameters

- ***string*** `$root`


##### Returns

- ***\Closure***

### Class: Psr0 - `\donatj\MDDoc\Autoloaders\Psr0`

#### Undocumented Method: `Psr0`::`makeAutoloader($root)`

### Class: AbstractDocPart - `\donatj\MDDoc\Documentation\AbstractDocPart`

#### Undocumented Method: `AbstractDocPart`->`setOptions($options, $tree_options)`
---

#### Method: `AbstractDocPart`->`getOption($key [, $tree = false])`

##### Parameters

- ***string*** `$key`
- ***bool*** `$tree`


##### Returns

- ***null*** | ***string***

### Class: AbstractNestedDoc - `\donatj\MDDoc\Documentation\AbstractNestedDoc`

#### Method: `AbstractNestedDoc`->`addChild($child)`

##### Parameters

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface*** `$child`



---

#### Method: `AbstractNestedDoc`->`setChildren($children)`

##### Parameters

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]*** `$children`



---

#### Method: `AbstractNestedDoc`->`getChildren()`

##### Returns

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

### Class: ClassFile - `\donatj\MDDoc\Documentation\ClassFile`

#### Undocumented Method: `ClassFile`->`output($depth)`
#### Undocumented Method: `ClassFile`->`setAutoloader($autoloader)`

### Class: DocPage - `\donatj\MDDoc\Documentation\DocPage`

#### Undocumented Method: `DocPage`->`output($depth)`

### Class: DocRoot - `\donatj\MDDoc\Documentation\DocRoot`

#### Undocumented Method: `DocRoot`->`output($depth)`

### Class: IncludeFile - `\donatj\MDDoc\Documentation\IncludeFile`

#### Method: `IncludeFile`->`output($depth)`

##### Parameters

- ***int*** `$depth`


##### Returns

- ***string***

### Class: IncludeSource - `\donatj\MDDoc\Documentation\IncludeSource`

#### Method: `IncludeSource`->`output($depth)`

##### Parameters

- ***int*** `$depth`


##### Returns

- ***string***

### Class: AutoloaderAware - `\donatj\MDDoc\Documentation\Interfaces\AutoloaderAware`

#### Undocumented Method: `AutoloaderAware`->`setAutoloader($autoloader)`

### Class: DocumentationInterface - `\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface`

#### Method: `DocumentationInterface`->`output($depth)`

##### Parameters

- ***int*** `$depth`


##### Returns

- ***string***

### Class: RecursiveDirectory - `\donatj\MDDoc\Documentation\RecursiveDirectory`

#### Undocumented Method: `RecursiveDirectory`->`setAutoloader($autoloader)`
#### Undocumented Method: `RecursiveDirectory`->`output($depth)`

### Class: Section - `\donatj\MDDoc\Documentation\Section`

#### Undocumented Method: `Section`->`output($depth)`

### Class: Text - `\donatj\MDDoc\Documentation\Text`

Class Text

#### Method: `Text`->`__construct($text)`

##### Parameters

- ***string*** `$text`



#### Undocumented Method: `Text`->`output($depth)`

### Class: ConfigException - `\donatj\MDDoc\Exceptions\ConfigException`

### Class: PathNotReadableException - `\donatj\MDDoc\Exceptions\PathNotReadableException`

### Class: TargetNotWritableException - `\donatj\MDDoc\Exceptions\TargetNotWritableException`

### Class: MDDoc - `\donatj\MDDoc\MDDoc`

Application MDDoc

#### Undocumented Method: `MDDoc`->`__construct($args)`

### Class: TaxonomyReflector - `\donatj\MDDoc\Reflectors\TaxonomyReflector`

#### Method: `TaxonomyReflector`->`__construct($filename, $autoLoader, $parserFactory)`

##### Parameters

- ***string*** `$filename`
- ***callable*** `$autoLoader`
- ***\donatj\MDDoc\Reflectors\TaxonomyReflectorFactory*** `$parserFactory`



---

#### Method: `TaxonomyReflector`->`getData()`

##### Returns

- ***mixed***


---

#### Method: `TaxonomyReflector`->`getReflector()`

##### Returns

- ***null*** | ***\phpDocumentor\Reflection\InterfaceReflector***


---

#### Method: `TaxonomyReflector`->`getMethods()`

##### Returns

- ***\phpDocumentor\Reflection\ClassReflector\MethodReflector[][]***

### Class: TaxonomyReflectorFactory - `\donatj\MDDoc\Reflectors\TaxonomyReflectorFactory`

#### Method: `TaxonomyReflectorFactory`->`newInstance($filename, $autoLoader)`

##### Parameters

- ***mixed*** `$filename`
- ***callable*** `$autoLoader`


##### Returns

- ***\donatj\MDDoc\Reflectors\TaxonomyReflector***

### Class: ConfigParser - `\donatj\MDDoc\Runner\ConfigParser`

#### Undocumented Method: `ConfigParser`->`__construct($filename)`

### Class: UserInterface - `\donatj\MDDoc\Runner\UserInterface`

#### Undocumented Method: `UserInterface`->`__construct($STDOUT, $STDERR)`
#### Undocumented Method: `UserInterface`->`dumpOptions($additional)`
#### Undocumented Method: `UserInterface`->`dropError($text [, $code = 1 [, $additional = false]])`
#### Undocumented Method: `UserInterface`->`outputMsg($text)`

Different Level

