# Full API Docs (WIP)

## Class: donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface

### Method: AutoloaderInterface->__invoke

```php
function __invoke(string $className) : ?string
```

Locate the filename of a given class

#### Returns:

- ***string*** | ***null*** - filename on class found, null on not found

## Class: donatj\MDDoc\Autoloaders\MultiLoader

A simple autoloader chain



### Method: `MultiLoader->__construct(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface ...$loaders)`

---

### Method: MultiLoader->__invoke

```php
function __invoke(string $className) : ?string
```

Locate the filename of a given class

#### Returns:

- ***string*** | ***null*** - filename on class found, null on not found

---

### Method: `MultiLoader->appendLoader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $loader)`

---

### Method: `MultiLoader->count()`

## Class: donatj\MDDoc\Autoloaders\NullLoader

### Method: NullLoader->__invoke

```php
function __invoke(string $className) : ?string
```

Locate the filename of a given class

#### Returns:

- ***string*** | ***null*** - filename on class found, null on not found

## Class: donatj\MDDoc\Autoloaders\Psr0

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

## Class: donatj\MDDoc\Autoloaders\Psr4

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

## Class: donatj\MDDoc\Documentation\AbstractDocPart



### Method: `AbstractDocPart->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `AbstractDocPart->getParent()`

---

### Method: `AbstractDocPart->getTextContent()`

---

### Method: AbstractDocPart->output

```php
function output(int $depth)
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

## Class: donatj\MDDoc\Documentation\AbstractElement



### Method: `AbstractElement->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `AbstractElement->getParent()`

---

### Method: `AbstractElement->getTextContent()`

## Class: donatj\MDDoc\Documentation\AbstractNestedDoc

### Method: AbstractNestedDoc->getChildren

```php
function getChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### Method: AbstractNestedDoc->getDocumentationChildren

```php
function getDocumentationChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### Method: `AbstractNestedDoc->addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children)`

---

### Method: `AbstractNestedDoc->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `AbstractNestedDoc->getParent()`

---

### Method: `AbstractNestedDoc->getTextContent()`

---

### Method: AbstractNestedDoc->output

```php
function output(int $depth)
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

## Class: donatj\MDDoc\Documentation\Autoloader

```php
<?php
namespace donatj\MDDoc\Documentation;

class Autoloader {
	/** The type of autoloader to use, either "psr0" or "psr4" */
	public const OPT_TYPE = 'type';
	/** The root directory of the autoloader */
	public const OPT_ROOT = 'root';
	/** The namespace of the autoloader, only used for psr4 */
	public const OPT_NAMESPACE = 'namespace';
}
```



### Method: `Autoloader->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `Autoloader->getType()`

---

### Method: `Autoloader->getRoot()`

---

### Method: `Autoloader->getNamespace()`

---

### Method: `Autoloader->getParent()`

---

### Method: `Autoloader->getTextContent()`

## Class: donatj\MDDoc\Documentation\Badges\Badge

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class Badge {
	/** The image url **(required)** */
	public const OPT_SRC = 'src';
	/** The image alt text **(required)** */
	public const OPT_ALT = 'alt';
	/** The optional url to link to wrap the badge in */
	public const OPT_HREF = 'href';
	/** The optional link title */
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

### Method: `Badge->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `Badge->getParent()`

---

### Method: `Badge->getTextContent()`

## Class: donatj\MDDoc\Documentation\Badges\BadgeCoveralls

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeCoveralls {
	/**
	 * The BadgeCoveralls name of the Project. Required.
	 * 
	 * This includes the service name, e.g. "github/donatj/php-dnf-solver"
	 */
	public const OPT_NAME = 'name';
	/** The branch to show. Defaults to empty which shows the default branch */
	public const OPT_BRANCH = 'branch';
	/** The image url **(required)** */
	public const OPT_SRC = 'src';
	/** The image alt text **(required)** */
	public const OPT_ALT = 'alt';
	/** The optional url to link to wrap the badge in */
	public const OPT_HREF = 'href';
	/** The optional link title */
	public const OPT_TITLE = 'title';
}
```

---

### Method: BadgeCoveralls->output

```php
function output(int $depth) : string
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `BadgeCoveralls->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `BadgeCoveralls->getParent()`

---

### Method: `BadgeCoveralls->getTextContent()`

## Class: donatj\MDDoc\Documentation\Badges\BadgeGitHubActions

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeGitHubActions {
	/** The name of the `.yml` file in the `.github/workflows/` directory including the `.yml` extension */
	public const OPT_NAME = 'name';
	/** The name of the branch to show the badge for. Defaults to the default branch. */
	public const OPT_BRANCH = 'branch';
	public const OPT_EVENT = 'event';
	/** The filename of the workflow file to use as the badge source */
	public const OPT_WORKFLOW_FILE = 'workflow-file';
	/** The image url **(required)** */
	public const OPT_SRC = 'src';
	/** The image alt text **(required)** */
	public const OPT_ALT = 'alt';
	/** The optional url to link to wrap the badge in */
	public const OPT_HREF = 'href';
	/** The optional link title */
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

### Method: `BadgeGitHubActions->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `BadgeGitHubActions->getParent()`

---

### Method: `BadgeGitHubActions->getTextContent()`

## Class: donatj\MDDoc\Documentation\Badges\BadgePoser

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgePoser {
	/** The type of badge to display. One of: "version" "downloads" "unstable" "license" "monthly" "daily" "phpversion" "composerlock" */
	public const OPT_TYPE = 'type';
	/** The packagist name of the package. Defaults to the name key of the composer.json file in the root of the project. Required if the composer.json file is not present. */
	public const OPT_NAME = 'name';
	/** The poser endpoint to use. Defaults based on the type */
	public const OPT_SUFFIX = 'suffix';
	/** The image url **(required)** */
	public const OPT_SRC = 'src';
	/** The image alt text **(required)** */
	public const OPT_ALT = 'alt';
	/** The optional url to link to wrap the badge in */
	public const OPT_HREF = 'href';
	/** The optional link title */
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

### Method: `BadgePoser->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `BadgePoser->getParent()`

---

### Method: `BadgePoser->getTextContent()`

## Class: donatj\MDDoc\Documentation\Badges\BadgeScrutinizer

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeScrutinizer {
	/** The packagist name of the Scrutinizer Project. Defaults to the name key of the composer.json file in the root of the project. Required if the composer.json file is not present. */
	public const OPT_NAME = 'name';
	/** The type of badge to display. One of: "quality" "coverage" "build-status" */
	public const OPT_TYPE = 'type';
	/** The Scrutinizer endpoint to use. Defaults based on the type */
	public const OPT_SUFFIX = 'suffix';
	/** The branch to show. Defaults to "master" */
	public const OPT_BRANCH = 'branch';
	/** The image url **(required)** */
	public const OPT_SRC = 'src';
	/** The image alt text **(required)** */
	public const OPT_ALT = 'alt';
	/** The optional url to link to wrap the badge in */
	public const OPT_HREF = 'href';
	/** The optional link title */
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

### Method: `BadgeScrutinizer->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `BadgeScrutinizer->getParent()`

---

### Method: `BadgeScrutinizer->getTextContent()`

## Class: donatj\MDDoc\Documentation\Badges\BadgeShielded

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeShielded {
	/** The ID of the badge to display when displaying a dynamic badge. */
	public const OPT_ID = 'id';
	/** The color of the badge when displaying a static badge. */
	public const OPT_COLOR = 'color';
	/** The title of the badge when displaying a static badge. */
	public const OPT_TITLE = 'title';
	/** The text of the badge when displaying a static badge. */
	public const OPT_TEXT = 'text';
	/** The image url **(required)** */
	public const OPT_SRC = 'src';
	/** The image alt text **(required)** */
	public const OPT_ALT = 'alt';
	/** The optional url to link to wrap the badge in */
	public const OPT_HREF = 'href';
}
```

---

### Method: BadgeShielded->output

```php
function output(int $depth) : string
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `BadgeShielded->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `BadgeShielded->getParent()`

---

### Method: `BadgeShielded->getTextContent()`

## Class: donatj\MDDoc\Documentation\Badges\BadgeTravis

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeTravis {
	/** The packagist name of the Travis Project. Defaults to the name key of the composer.json file in the root of the project. Required if the composer.json file is not present. */
	public const OPT_NAME = 'name';
	/** The branch to show. Defaults to "master" */
	public const OPT_BRANCH = 'branch';
	/** The image url **(required)** */
	public const OPT_SRC = 'src';
	/** The image alt text **(required)** */
	public const OPT_ALT = 'alt';
	/** The optional url to link to wrap the badge in */
	public const OPT_HREF = 'href';
	/** The optional link title */
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

### Method: `BadgeTravis->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `BadgeTravis->getParent()`

---

### Method: `BadgeTravis->getTextContent()`

## Class: donatj\MDDoc\Documentation\ComposerInstall

```php
<?php
namespace donatj\MDDoc\Documentation;

class ComposerInstall {
	/** Text to display before the install command */
	public const OPT_TEXT = 'text';
	/** Whether to include global subcommand */
	public const OPT_GLOBAL = 'global';
	/** Whether to include --dev flag */
	public const OPT_DEV = 'dev';
	/** Package name override. Comma delimited. Defaults to `name` key of composer.json */
	public const OPT_PACKAGE_NAMES = 'package-names';
}
```

### Method: ComposerInstall->output

```php
function output(int $depth) : \donatj\MDDom\Paragraph
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `ComposerInstall->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `ComposerInstall->getParent()`

---

### Method: `ComposerInstall->getTextContent()`

## Class: donatj\MDDoc\Documentation\ComposerRequires

### Method: ComposerRequires->output

```php
function output(int $depth) : \donatj\MDDom\Paragraph
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `ComposerRequires->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `ComposerRequires->getParent()`

---

### Method: `ComposerRequires->getTextContent()`

## Class: donatj\MDDoc\Documentation\DocPage

```php
<?php
namespace donatj\MDDoc\Documentation;

class DocPage {
	/** Filename to output */
	public const OPT_TARGET = 'target';
	/** Optional custom link for parent documents */
	public const OPT_LINK = 'link';
	/** Optional custom text for the link in parent documents */
	public const OPT_LINK_TEXT = 'link-text';
	/** Optional custom text to precede the link in parent documents */
	public const OPT_LINK_PRE_TEXT = 'link-pre-text';
	/** Optional custom text to follow the link in parent documents */
	public const OPT_LINK_POST_TEXT = 'link-post-text';
}
```

### Method: DocPage->output

```php
function output(int $depth) : string
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: DocPage->getChildren

```php
function getChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### Method: DocPage->getDocumentationChildren

```php
function getDocumentationChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### Method: `DocPage->addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children)`

---

### Method: `DocPage->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `DocPage->getParent()`

---

### Method: `DocPage->getTextContent()`

## Class: donatj\MDDoc\Documentation\DocRoot

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

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### Method: DocRoot->getDocumentationChildren

```php
function getDocumentationChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### Method: `DocRoot->addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children)`

---

### Method: `DocRoot->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `DocRoot->getParent()`

---

### Method: `DocRoot->getTextContent()`

## Class: donatj\MDDoc\Documentation\Exceptions\ExecutionException

## Class: donatj\MDDoc\Documentation\Exceptions\UnhandledConfigTagException

## Class: donatj\MDDoc\Documentation\ExecOutput

```php
<?php
namespace donatj\MDDoc\Documentation;

class ExecOutput {
	/** The command to execute */
	public const OPT_CMD = 'cmd';
	/** The format to output the result in - options include "raw" "code" and "code-block" defaults to "raw" */
	public const OPT_FORMAT = 'format';
	/** Set to 'true' to allow non-zero exit codes to continue */
	public const OPT_ALLOW_ERROR = 'allow-error';
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

**Throws**: `\donatj\MDDoc\Exceptions\ConfigException`

**Throws**: `\donatj\MDDoc\Documentation\Exceptions\ExecutionException`

---

### Method: `ExecOutput->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `ExecOutput->getParent()`

---

### Method: `ExecOutput->getTextContent()`

## Class: donatj\MDDoc\Documentation\IncludeFile

```php
<?php
namespace donatj\MDDoc\Documentation;

class IncludeFile {
	/** The poth of the file to include */
	public const OPT_NAME = 'name';
}
```

### Method: IncludeFile->output

```php
function output(int $depth) : \donatj\MDDom\Paragraph
```

**Throws**: `\donatj\MDDoc\Exceptions\PathNotReadableException`

---

### Method: `IncludeFile->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `IncludeFile->getParent()`

---

### Method: `IncludeFile->getTextContent()`

## Class: donatj\MDDoc\Documentation\Interfaces\AutoloaderAware



### Method: `AutoloaderAware->setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader)`

## Class: donatj\MDDoc\Documentation\Interfaces\DocumentationInterface

### Method: DocumentationInterface->output

```php
function output(int $depth)
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `DocumentationInterface->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent)`

## Class: donatj\MDDoc\Documentation\Interfaces\ElementInterface



### Method: `ElementInterface->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent)`

## Class: donatj\MDDoc\Documentation\PhpFileDocs

```php
<?php
namespace donatj\MDDoc\Documentation;

class PhpFileDocs {
	/** The file to document */
	public const OPT_NAME = 'name';
	/** Skip the class header line */
	public const OPT_SKIP_CLASS_HEADER = 'skip-class-header';
	/** Skip the class constants section */
	public const OPT_SKIP_CLASS_CONSTANTS = 'skip-class-constants';
	/** Regex to filter methods by - specify methods to be matched */
	public const OPT_METHOD_FILTER = 'method-filter';
	/** Skip the method return section */
	public const OPT_SKIP_METHOD_RETURNS = 'skip-method-returns';
	/** Generate warning for undocumented methods. Defaults to "true". */
	public const OPT_WARN_UNDOCUMENTED = 'warn-undocumented';
}
```

### Method: PhpFileDocs->output

```php
function output(int $depth)
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string***

---

### Method: `PhpFileDocs->setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader)`

---

### Method: `PhpFileDocs->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `PhpFileDocs->getParent()`

---

### Method: `PhpFileDocs->getTextContent()`

## Class: donatj\MDDoc\Documentation\RecursiveDirectory

```php
<?php
namespace donatj\MDDoc\Documentation;

class RecursiveDirectory {
	/** The directory to recursively search for files to document */
	public const OPT_NAME = 'name';
	/** A regex to filter files by - specify files to be matched */
	public const OPT_FILE_FILTER = 'file-filter';
}
```



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

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### Method: RecursiveDirectory->getDocumentationChildren

```php
function getDocumentationChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### Method: `RecursiveDirectory->addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children)`

---

### Method: `RecursiveDirectory->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `RecursiveDirectory->getParent()`

---

### Method: `RecursiveDirectory->getTextContent()`

## Class: donatj\MDDoc\Documentation\Replace

```php
<?php
namespace donatj\MDDoc\Documentation;

class Replace {
	/** The text to search for */
	public const OPT_SEARCH = 'search';
	/** The text to replace with */
	public const OPT_REPLACE = 'replace';
	/** Whether to use a regex or not - expects "true" or "false" - defaults to "false" */
	public const OPT_REGEX = 'regex';
}
```

### Method: Replace->output

```php
function output(int $depth) : string
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: Replace->getChildren

```php
function getChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### Method: Replace->getDocumentationChildren

```php
function getDocumentationChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### Method: `Replace->addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children)`

---

### Method: `Replace->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `Replace->getParent()`

---

### Method: `Replace->getTextContent()`

## Class: donatj\MDDoc\Documentation\Section

```php
<?php
namespace donatj\MDDoc\Documentation;

class Section {
	/** The heading of the section */
	public const OPT_TITLE = 'title';
}
```

### Method: Section->output

```php
function output(int $depth) : \donatj\MDDom\DocumentDepth
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: Section->getChildren

```php
function getChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### Method: Section->getDocumentationChildren

```php
function getDocumentationChildren() : array
```

#### Returns:

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### Method: `Section->addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children)`

---

### Method: `Section->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `Section->getParent()`

---

### Method: `Section->getTextContent()`

## Class: donatj\MDDoc\Documentation\Source

Class Source

```php
<?php
namespace donatj\MDDoc\Documentation;

class Source {
	/** filename of optional source file */
	public const OPT_NAME = 'name';
	/** Optional language name for the opening */
	public const OPT_LANG = 'lang';
}
```

### Method: Source->output

```php
function output(int $depth) : \donatj\MDDom\AbstractElement
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `Source->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `Source->getParent()`

---

### Method: `Source->getTextContent()`

## Class: donatj\MDDoc\Documentation\Text

### Method: Text->output

```php
function output(int $depth) : \donatj\MDDom\AbstractElement
```

#### Returns:

- ***\donatj\MDDom\AbstractElement*** | ***string*** - Cannot be annotated as also accepts __toString-able objects

---

### Method: `Text->__construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree [, string $textContent = ''])`

---

### Method: `Text->getParent()`

---

### Method: `Text->getTextContent()`

## Class: donatj\MDDoc\ElementFactory

Links XML Tags to their Given Documentation Generator

```php
<?php
namespace donatj\MDDoc;

class ElementFactory {
	public const DEFAULT_ELEMENTS = [\donatj\MDDoc\Documentation\Autoloader::class, \donatj\MDDoc\Documentation\Section::class, \donatj\MDDoc\Documentation\Replace::class, \donatj\MDDoc\Documentation\DocPage::class, \donatj\MDDoc\Documentation\Text::class, \donatj\MDDoc\Documentation\PhpFileDocs::class, \donatj\MDDoc\Documentation\RecursiveDirectory::class, \donatj\MDDoc\Documentation\IncludeFile::class, \donatj\MDDoc\Documentation\Source::class, \donatj\MDDoc\Documentation\ComposerInstall::class, \donatj\MDDoc\Documentation\ComposerRequires::class, \donatj\MDDoc\Documentation\Badges\Badge::class, \donatj\MDDoc\Documentation\Badges\BadgeCoveralls::class, \donatj\MDDoc\Documentation\Badges\BadgePoser::class, \donatj\MDDoc\Documentation\Badges\BadgeTravis::class, \donatj\MDDoc\Documentation\Badges\BadgeScrutinizer::class, \donatj\MDDoc\Documentation\Badges\BadgeShielded::class, \donatj\MDDoc\Documentation\Badges\BadgeGitHubActions::class, \donatj\MDDoc\Documentation\ExecOutput::class];
}
```

### Method: ElementFactory->__construct

```php
function __construct(\donatj\MDDoc\Runner\TextUI $ui)
```

ElementFactory constructor.

---

### Method: ElementFactory->makeFromTag

```php
function makeFromTag(string $tagName, \donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent) : \donatj\MDDoc\Documentation\Interfaces\ElementInterface
```

Return a populated DocumentationInterface of the corresponding tagName

## Class: donatj\MDDoc\Exceptions\ClassNotReadableException



### Method: `ClassNotReadableException->__construct(string $message, string $path [, ?\Exception $previous_exception = null])`

---

### Method: `ClassNotReadableException->getPath()`

## Class: donatj\MDDoc\Exceptions\ConfigException

## Class: donatj\MDDoc\Exceptions\MDDocException

## Class: donatj\MDDoc\Exceptions\PathNotReadableException



### Method: `PathNotReadableException->__construct(string $message, string $path [, ?\Exception $previous_exception = null])`

---

### Method: `PathNotReadableException->getPath()`

## Class: donatj\MDDoc\Exceptions\TargetNotWritableException

## Class: donatj\MDDoc\MDDoc

Application MDDoc

```php
<?php
namespace donatj\MDDoc;

class MDDoc {
	public const VERSION = "0.1.0";
}
```

### Method: MDDoc->__construct

```php
function __construct(array $args)
```

#### Parameters:

- ***string[]*** `$args`

## Class: donatj\MDDoc\Reflectors\TaxonomyReflector

### Method: TaxonomyReflector->__construct

```php
function __construct(string $filename, \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader, \donatj\MDDoc\Reflectors\TaxonomyReflectorFactory $parserFactory)
```

**Throws**: `\donatj\MDDoc\Exceptions\ClassNotReadableException`

---

### Method: TaxonomyReflector->getReflector

```php
function getReflector() : ?\phpDocumentor\Reflection\Element
```

#### Returns:

- ***\phpDocumentor\Reflection\Php\Class_*** | ***\phpDocumentor\Reflection\Php\Interface_*** | ***\phpDocumentor\Reflection\Php\Trait_*** | ***null***

---

### Method: TaxonomyReflector->getDocMethods

```php
function getDocMethods() : array
```

#### Returns:

- ***\phpDocumentor\Reflection\DocBlock\Tags\Method[][]***

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

---

### Method: TaxonomyReflector->getFunctions

```php
function getFunctions() : array
```

#### Returns:

- ***\phpDocumentor\Reflection\Php\Function_[]***

## Class: donatj\MDDoc\Reflectors\TaxonomyReflectorFactory

### Method: TaxonomyReflectorFactory->newInstance

```php
function newInstance(string $filename, \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader) : \donatj\MDDoc\Reflectors\TaxonomyReflector
```

**Throws**: `\donatj\MDDoc\Exceptions\ClassNotReadableException`

## Class: donatj\MDDoc\Runner\ConfigParser



### Method: `ConfigParser->__construct(\donatj\MDDoc\ElementFactory $documentationFactory, \donatj\MDDoc\Runner\TextUI $ui)`

---

### Method: ConfigParser->parse

```php
function parse(string $filename) : \donatj\MDDoc\Documentation\DocRoot
```

Parse a config file

**Throws**: `\donatj\MDDoc\Exceptions\ConfigException`

#### Returns:

- ***\donatj\MDDoc\Documentation\DocRoot***

## Class: donatj\MDDoc\Runner\ImmutableAttributeTree

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

## Class: donatj\MDDoc\Runner\TextUI

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

### Method: `TextUI->log($level, $message [, array $context = []])`