# MDDoc

A simple, directed phpDoc => Markdown generator.

This is a work in progress and not ready for use.

This projects goal is to be able to define a set of directions for *how* to document a set of PHP files as well as markdown and other text to include, and output the final documentation in a jekyll or other markdown site builder ready form.

## Documentation Example (WIP)



### Class: AutoloaderInterface \[ `\donatj\MDDoc\Autoloaders\Interfaces` \]

#### Method: `AutoloaderInterface`::`makeAutoloader($root)`

##### Parameters:

- ***string*** `$root`


##### Returns:

- ***\Closure***

### Class: Psr0 \[ `\donatj\MDDoc\Autoloaders` \]

#### Undocumented Method: `Psr0`::`makeAutoloader($root)`

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

### Class: ClassFile \[ `\donatj\MDDoc\Documentation` \]

#### Undocumented Method: `ClassFile`->`output($depth)`
#### Undocumented Method: `ClassFile`->`setAutoloader($autoloader)`

### Class: DocPage \[ `\donatj\MDDoc\Documentation` \]

#### Undocumented Method: `DocPage`->`output($depth)`

### Class: DocRoot \[ `\donatj\MDDoc\Documentation` \]

#### Undocumented Method: `DocRoot`->`output($depth)`

### Class: IncludeFile \[ `\donatj\MDDoc\Documentation` \]

#### Method: `IncludeFile`->`output($depth)`

##### Parameters:

- ***int*** `$depth`


##### Returns:

- ***string***

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
#### Undocumented Method: `RecursiveDirectory`->`output($depth)`

### Class: Section \[ `\donatj\MDDoc\Documentation` \]

#### Undocumented Method: `Section`->`output($depth)`



### Class: Text \[ `\donatj\MDDoc\Documentation` \]

Class Text

#### Undocumented Method: `Text`->`__construct($options, $tree_options [, $text = ''])`
#### Undocumented Method: `Text`->`output($depth)`

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
- ***callable*** `$autoLoader`
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
- ***callable*** `$autoLoader`


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

