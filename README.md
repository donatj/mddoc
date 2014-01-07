# MDDoc

A simple, directed phpDoc => Markdown generator.

This is a work in progress and not ready for use.

This projects goal is to be able to define a set of directions for *how* to document a set of PHP files as well as markdown and other text to include, and output the final documentation in a jekyll or other markdown site builder ready form.

## Documentation Example (WIP)



### Class: Psr0 - `\donatj\MDDoc\Autoloaders\Psr0`

#### Undocumented Method: `Psr0`::`makeAutoloader($root)`

### Class: AbstractNestedDoc - `\donatj\MDDoc\Documentation\AbstractNestedDoc`

#### Method: `AbstractNestedDoc`->`addChild($child)`

##### Parameters

- ***\donatj\MDDoc\Interfaces\DocInterface*** `$child`



---

#### Method: `AbstractNestedDoc`->`setChildren($children)`

##### Parameters

- ***\donatj\MDDoc\Interfaces\DocInterface[]*** `$children`



---

#### Method: `AbstractNestedDoc`->`getChildren()`

##### Returns

- ***\donatj\MDDoc\Interfaces\DocInterface[]***

### Class: DocPage - `\donatj\MDDoc\Documentation\DocPage`

#### Undocumented Method: `DocPage`->`__construct($target)`
#### Undocumented Method: `DocPage`->`output($depth)`

### Class: DocRoot - `\donatj\MDDoc\Documentation\DocRoot`

#### Undocumented Method: `DocRoot`->`__construct()`
#### Undocumented Method: `DocRoot`->`output($depth)`

### Class: File - `\donatj\MDDoc\Documentation\File`

#### Undocumented Method: `File`->`__construct($name)`
#### Undocumented Method: `File`->`output($depth)`
#### Undocumented Method: `File`->`setAutoloader($autoloader)`

### Class: IncludeFile - `\donatj\MDDoc\Documentation\IncludeFile`

#### Undocumented Method: `IncludeFile`->`__construct($name)`
---

#### Method: `IncludeFile`->`output($depth)`

##### Parameters

- ***int*** `$depth`


##### Returns

- ***string***

### Class: IncludeSource - `\donatj\MDDoc\Documentation\IncludeSource`

#### Undocumented Method: `IncludeSource`->`__construct($name [, $lang = null])`
---

#### Method: `IncludeSource`->`output($depth)`

##### Parameters

- ***int*** `$depth`


##### Returns

- ***string***

### Class: RecursiveDirectory - `\donatj\MDDoc\Documentation\RecursiveDirectory`

#### Undocumented Method: `RecursiveDirectory`->`__construct($name)`
#### Undocumented Method: `RecursiveDirectory`->`setAutoloader($autoloader)`
#### Undocumented Method: `RecursiveDirectory`->`output($depth)`

### Class: Section - `\donatj\MDDoc\Documentation\Section`

#### Undocumented Method: `Section`->`__construct($title)`
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

### Class: AutoloaderAware - `\donatj\MDDoc\Interfaces\AutoloaderAware`

#### Undocumented Method: `AutoloaderAware`->`setAutoloader($autoloader)`

### Class: AutoloaderInterface - `\donatj\MDDoc\Interfaces\AutoloaderInterface`

#### Method: `AutoloaderInterface`::`makeAutoloader($root)`

##### Parameters

- ***string*** `$root`


##### Returns

- ***\Closure***

### Class: DocInterface - `\donatj\MDDoc\Interfaces\DocInterface`

#### Method: `DocInterface`->`output($depth)`

##### Parameters

- ***int*** `$depth`


##### Returns

- ***string***

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


#### Undocumented Method: `TaxonomyReflector`->`getMethods()`

### Class: TaxonomyReflectorFactory - `\donatj\MDDoc\Reflectors\TaxonomyReflectorFactory`

#### Method: `TaxonomyReflectorFactory`->`newInstance($filename, $autoLoader)`

##### Parameters

- ***mixed*** `$filename`
- ***callable*** `$autoLoader`


##### Returns

- ***\donatj\MDDoc\Reflectors\TaxonomyReflector***

### Class: ConfigParser - `\donatj\MDDoc\Runner\ConfigParser`

#### Undocumented Method: `ConfigParser`->`__construct($filename)`

