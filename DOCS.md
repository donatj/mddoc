# Full API Docs (WIP)

Set `table-of-contents="true"` on a `recursive-directory` to link documented types and methods.

## Table of Contents

- [class donatj\MDDoc\Autoloaders\ComposerAutoloader](#mddoc-class-donatj-mddoc-autoloaders-composerautoloader)
    - [function __construct(\Composer\Autoload\ClassLoader $loader)](#mddoc-method-donatj-mddoc-autoloaders-composerautoloader-construct)
    - [function __invoke(string $className): ?string](#mddoc-method-donatj-mddoc-autoloaders-composerautoloader-invoke)
- [interface donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface](#mddoc-interface-donatj-mddoc-autoloaders-interfaces-autoloaderinterface)
    - [function __invoke(string $className): ?string](#mddoc-method-donatj-mddoc-autoloaders-interfaces-autoloaderinterface-invoke)
- [class donatj\MDDoc\Autoloaders\MultiLoader](#mddoc-class-donatj-mddoc-autoloaders-multiloader)
    - [function __construct(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface ...$loaders)](#mddoc-method-donatj-mddoc-autoloaders-multiloader-construct)
    - [function __invoke(string $className): ?string](#mddoc-method-donatj-mddoc-autoloaders-multiloader-invoke)
    - [function appendLoader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $loader): void](#mddoc-method-donatj-mddoc-autoloaders-multiloader-appendloader)
    - [function count(): int](#mddoc-method-donatj-mddoc-autoloaders-multiloader-count)
- [class donatj\MDDoc\Autoloaders\NullLoader](#mddoc-class-donatj-mddoc-autoloaders-nullloader)
    - [function __invoke(string $className): ?string](#mddoc-method-donatj-mddoc-autoloaders-nullloader-invoke)
- [class donatj\MDDoc\Autoloaders\Psr0](#mddoc-class-donatj-mddoc-autoloaders-psr0)
    - [function __construct(string $path)](#mddoc-method-donatj-mddoc-autoloaders-psr0-construct)
    - [function __invoke(string $className): ?string](#mddoc-method-donatj-mddoc-autoloaders-psr0-invoke)
- [class donatj\MDDoc\Autoloaders\Psr4](#mddoc-class-donatj-mddoc-autoloaders-psr4)
    - [function __construct(string $root_namespace, string $path)](#mddoc-method-donatj-mddoc-autoloaders-psr4-construct)
    - [function __invoke(string $className): ?string](#mddoc-method-donatj-mddoc-autoloaders-psr4-invoke)
- [class donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-class-donatj-mddoc-documentation-abstractdocpart)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-abstractdocpart-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-abstractdocpart-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-abstractdocpart-gettextcontent)
    - [function output(int $depth)](#mddoc-method-donatj-mddoc-documentation-abstractdocpart-output)
- [class donatj\MDDoc\Documentation\AbstractElement](#mddoc-class-donatj-mddoc-documentation-abstractelement)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-abstractelement-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-abstractelement-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-abstractelement-gettextcontent)
- [class donatj\MDDoc\Documentation\AbstractNestedDoc](#mddoc-class-donatj-mddoc-documentation-abstractnesteddoc)
    - [function getChildren(): array](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-getchildren)
    - [function getDocumentationChildren(): array](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-getdocumentationchildren)
    - [function addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children): void](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-addchildren)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-gettextcontent)
    - [function output(int $depth)](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-output)
- [class donatj\MDDoc\Documentation\Autoloader](#mddoc-class-donatj-mddoc-documentation-autoloader)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-autoloader-construct)
    - [function getType(): string](#mddoc-method-donatj-mddoc-documentation-autoloader-gettype)
    - [function getRoot(): string](#mddoc-method-donatj-mddoc-documentation-autoloader-getroot)
    - [function getNamespace(): string](#mddoc-method-donatj-mddoc-documentation-autoloader-getnamespace)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-autoloader-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-autoloader-gettextcontent)
- [class donatj\MDDoc\Documentation\Badges\Badge](#mddoc-class-donatj-mddoc-documentation-badges-badge)
    - [function output(int $depth): string](#mddoc-method-donatj-mddoc-documentation-badges-badge-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-badges-badge-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-badges-badge-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-badges-badge-gettextcontent)
- [class donatj\MDDoc\Documentation\Badges\BadgeCoveralls](#mddoc-class-donatj-mddoc-documentation-badges-badgecoveralls)
    - [function output(int $depth): string](#mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-gettextcontent)
    - [function setLogger(\Psr\Log\LoggerInterface $logger): void](#mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-setlogger)
- [class donatj\MDDoc\Documentation\Badges\BadgeGitHubActions](#mddoc-class-donatj-mddoc-documentation-badges-badgegithubactions)
    - [function output(int $depth): string](#mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-gettextcontent)
- [class donatj\MDDoc\Documentation\Badges\BadgePoser](#mddoc-class-donatj-mddoc-documentation-badges-badgeposer)
    - [function output(int $depth): string](#mddoc-method-donatj-mddoc-documentation-badges-badgeposer-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-badges-badgeposer-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-badges-badgeposer-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-badges-badgeposer-gettextcontent)
- [class donatj\MDDoc\Documentation\Badges\BadgeScrutinizer](#mddoc-class-donatj-mddoc-documentation-badges-badgescrutinizer)
    - [function output(int $depth): string](#mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-gettextcontent)
- [class donatj\MDDoc\Documentation\Badges\BadgeShielded](#mddoc-class-donatj-mddoc-documentation-badges-badgeshielded)
    - [function output(int $depth): string](#mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-gettextcontent)
- [class donatj\MDDoc\Documentation\Badges\BadgeTravis](#mddoc-class-donatj-mddoc-documentation-badges-badgetravis)
    - [function output(int $depth): string](#mddoc-method-donatj-mddoc-documentation-badges-badgetravis-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-badges-badgetravis-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-badges-badgetravis-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-badges-badgetravis-gettextcontent)
- [class donatj\MDDoc\Documentation\ComposerInstall](#mddoc-class-donatj-mddoc-documentation-composerinstall)
    - [function output(int $depth): \donatj\MDDom\Paragraph](#mddoc-method-donatj-mddoc-documentation-composerinstall-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-composerinstall-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-composerinstall-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-composerinstall-gettextcontent)
- [class donatj\MDDoc\Documentation\ComposerRequires](#mddoc-class-donatj-mddoc-documentation-composerrequires)
    - [function output(int $depth): \donatj\MDDom\Paragraph](#mddoc-method-donatj-mddoc-documentation-composerrequires-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-composerrequires-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-composerrequires-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-composerrequires-gettextcontent)
- [class donatj\MDDoc\Documentation\DocPage](#mddoc-class-donatj-mddoc-documentation-docpage)
    - [function output(int $depth): string](#mddoc-method-donatj-mddoc-documentation-docpage-output)
    - [function setDocumentationOutputStrategy(\donatj\MDDoc\Runner\DocumentationOutputStrategy $documentationOutputStrategy): void](#mddoc-method-donatj-mddoc-documentation-docpage-setdocumentationoutputstrategy)
    - [function getChildren(): array](#mddoc-method-donatj-mddoc-documentation-docpage-getchildren)
    - [function getDocumentationChildren(): array](#mddoc-method-donatj-mddoc-documentation-docpage-getdocumentationchildren)
    - [function addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children): void](#mddoc-method-donatj-mddoc-documentation-docpage-addchildren)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-docpage-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-docpage-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-docpage-gettextcontent)
- [class donatj\MDDoc\Documentation\DocRoot](#mddoc-class-donatj-mddoc-documentation-docroot)
    - [function output(int $depth)](#mddoc-method-donatj-mddoc-documentation-docroot-output)
    - [function getChildren(): array](#mddoc-method-donatj-mddoc-documentation-docroot-getchildren)
    - [function getDocumentationChildren(): array](#mddoc-method-donatj-mddoc-documentation-docroot-getdocumentationchildren)
    - [function addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children): void](#mddoc-method-donatj-mddoc-documentation-docroot-addchildren)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-docroot-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-docroot-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-docroot-gettextcontent)
- [class donatj\MDDoc\Documentation\Exceptions\ExecutionException](#mddoc-class-donatj-mddoc-documentation-exceptions-executionexception)
- [class donatj\MDDoc\Documentation\Exceptions\UnhandledConfigTagException](#mddoc-class-donatj-mddoc-documentation-exceptions-unhandledconfigtagexception)
- [class donatj\MDDoc\Documentation\ExecOutput](#mddoc-class-donatj-mddoc-documentation-execoutput)
    - [function output(int $depth): \donatj\MDDom\AbstractElement](#mddoc-method-donatj-mddoc-documentation-execoutput-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-execoutput-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-execoutput-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-execoutput-gettextcontent)
- [class donatj\MDDoc\Documentation\IncludeFile](#mddoc-class-donatj-mddoc-documentation-includefile)
    - [function output(int $depth): \donatj\MDDom\Paragraph](#mddoc-method-donatj-mddoc-documentation-includefile-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-includefile-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-includefile-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-includefile-gettextcontent)
- [interface donatj\MDDoc\Documentation\Interfaces\AutoloaderAware](#mddoc-interface-donatj-mddoc-documentation-interfaces-autoloaderaware)
    - [function setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader): void](#mddoc-method-donatj-mddoc-documentation-interfaces-autoloaderaware-setautoloader)
- [interface donatj\MDDoc\Documentation\Interfaces\DocumentationInterface](#mddoc-interface-donatj-mddoc-documentation-interfaces-documentationinterface)
    - [function output(int $depth)](#mddoc-method-donatj-mddoc-documentation-interfaces-documentationinterface-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent)](#mddoc-method-donatj-mddoc-documentation-interfaces-documentationinterface-construct)
- [interface donatj\MDDoc\Documentation\Interfaces\DocumentationOutputStrategyAware](#mddoc-interface-donatj-mddoc-documentation-interfaces-documentationoutputstrategyaware)
    - [function setDocumentationOutputStrategy(\donatj\MDDoc\Runner\DocumentationOutputStrategy $documentationOutputStrategy): void](#mddoc-method-donatj-mddoc-documentation-interfaces-documentationoutputstrategyaware-setdocumentationoutputstrategy)
- [interface donatj\MDDoc\Documentation\Interfaces\ElementInterface](#mddoc-interface-donatj-mddoc-documentation-interfaces-elementinterface)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent)](#mddoc-method-donatj-mddoc-documentation-interfaces-elementinterface-construct)
- [class donatj\MDDoc\Documentation\PhpFileDocs](#mddoc-class-donatj-mddoc-documentation-phpfiledocs)
    - [function output(int $depth)](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-output)
    - [function setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader): void](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-setautoloader)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-gettextcontent)
    - [function setLogger(\Psr\Log\LoggerInterface $logger): void](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-setlogger)
- [class donatj\MDDoc\Documentation\RecursiveDirectory](#mddoc-class-donatj-mddoc-documentation-recursivedirectory)
    - [function setAutoloader(\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader): void](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-setautoloader)
    - [function output(int $depth): \donatj\MDDom\Document](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-output)
    - [function getChildren(): array](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-getchildren)
    - [function getDocumentationChildren(): array](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-getdocumentationchildren)
    - [function addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children): void](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-addchildren)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-gettextcontent)
    - [function setLogger(\Psr\Log\LoggerInterface $logger): void](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-setlogger)
- [class donatj\MDDoc\Documentation\Replace](#mddoc-class-donatj-mddoc-documentation-replace)
    - [function output(int $depth): string](#mddoc-method-donatj-mddoc-documentation-replace-output)
    - [function getChildren(): array](#mddoc-method-donatj-mddoc-documentation-replace-getchildren)
    - [function getDocumentationChildren(): array](#mddoc-method-donatj-mddoc-documentation-replace-getdocumentationchildren)
    - [function addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children): void](#mddoc-method-donatj-mddoc-documentation-replace-addchildren)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-replace-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-replace-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-replace-gettextcontent)
- [class donatj\MDDoc\Documentation\Section](#mddoc-class-donatj-mddoc-documentation-section)
    - [function output(int $depth): \donatj\MDDom\DocumentDepth](#mddoc-method-donatj-mddoc-documentation-section-output)
    - [function getChildren(): array](#mddoc-method-donatj-mddoc-documentation-section-getchildren)
    - [function getDocumentationChildren(): array](#mddoc-method-donatj-mddoc-documentation-section-getdocumentationchildren)
    - [function addChildren(\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children): void](#mddoc-method-donatj-mddoc-documentation-section-addchildren)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-section-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-section-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-section-gettextcontent)
- [class donatj\MDDoc\Documentation\Source](#mddoc-class-donatj-mddoc-documentation-source)
    - [function output(int $depth): \donatj\MDDom\AbstractElement](#mddoc-method-donatj-mddoc-documentation-source-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-source-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-source-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-source-gettextcontent)
- [class donatj\MDDoc\Documentation\Text](#mddoc-class-donatj-mddoc-documentation-text)
    - [function output(int $depth): \donatj\MDDom\AbstractElement](#mddoc-method-donatj-mddoc-documentation-text-output)
    - [function __construct(\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent = '')](#mddoc-method-donatj-mddoc-documentation-text-construct)
    - [function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-method-donatj-mddoc-documentation-text-getparent)
    - [function getTextContent(): string](#mddoc-method-donatj-mddoc-documentation-text-gettextcontent)
- [class donatj\MDDoc\ElementFactory](#mddoc-class-donatj-mddoc-elementfactory)
    - [function __construct(\donatj\MDDoc\Runner\TextUI $ui, \donatj\MDDoc\Runner\DocumentationOutputStrategy $documentationOutputStrategy)](#mddoc-method-donatj-mddoc-elementfactory-construct)
    - [function makeFromTag(string $tagName, \donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree, string $textContent): \donatj\MDDoc\Documentation\Interfaces\ElementInterface](#mddoc-method-donatj-mddoc-elementfactory-makefromtag)
- [class donatj\MDDoc\Exceptions\ClassNotReadableException](#mddoc-class-donatj-mddoc-exceptions-classnotreadableexception)
    - [function __construct(string $message, string $path, ?\Exception $previous_exception = null)](#mddoc-method-donatj-mddoc-exceptions-classnotreadableexception-construct)
    - [function getPath(): string](#mddoc-method-donatj-mddoc-exceptions-classnotreadableexception-getpath)
- [class donatj\MDDoc\Exceptions\ConfigException](#mddoc-class-donatj-mddoc-exceptions-configexception)
- [class donatj\MDDoc\Exceptions\DryRunMismatchException](#mddoc-class-donatj-mddoc-exceptions-dryrunmismatchexception)
    - [function __construct(string $target)](#mddoc-method-donatj-mddoc-exceptions-dryrunmismatchexception-construct)
    - [function getTarget(): string](#mddoc-method-donatj-mddoc-exceptions-dryrunmismatchexception-gettarget)
- [class donatj\MDDoc\Exceptions\MDDocException](#mddoc-class-donatj-mddoc-exceptions-mddocexception)
- [class donatj\MDDoc\Exceptions\PathNotReadableException](#mddoc-class-donatj-mddoc-exceptions-pathnotreadableexception)
    - [function __construct(string $message, string $path, ?\Exception $previous_exception = null)](#mddoc-method-donatj-mddoc-exceptions-pathnotreadableexception-construct)
    - [function getPath(): string](#mddoc-method-donatj-mddoc-exceptions-pathnotreadableexception-getpath)
- [class donatj\MDDoc\Exceptions\TargetNotWritableException](#mddoc-class-donatj-mddoc-exceptions-targetnotwritableexception)
- [class donatj\MDDoc\MDDoc](#mddoc-class-donatj-mddoc-mddoc)
    - [function __construct(array $args)](#mddoc-method-donatj-mddoc-mddoc-construct)
- [class donatj\MDDoc\Reflectors\TaxonomyReflector](#mddoc-class-donatj-mddoc-reflectors-taxonomyreflector)
    - [function __construct(string $filename, \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader, \donatj\MDDoc\Reflectors\TaxonomyReflectorFactory $parserFactory)](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-construct)
    - [function getReflector(): ?\donatj\MDDoc\Reflectors\Source\Element](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getreflector)
    - [function getDocMethods(): array](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getdocmethods)
    - [function getMethods(): array](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getmethods)
    - [function getConstants(): array](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getconstants)
    - [function getProperties(): array](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getproperties)
    - [function getFunctions(): array](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getfunctions)
- [class donatj\MDDoc\Reflectors\TaxonomyReflectorFactory](#mddoc-class-donatj-mddoc-reflectors-taxonomyreflectorfactory)
    - [function newInstance(string $filename, \donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader): \donatj\MDDoc\Reflectors\TaxonomyReflector](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflectorfactory-newinstance)
- [class donatj\MDDoc\Runner\ConfigParser](#mddoc-class-donatj-mddoc-runner-configparser)
    - [function __construct(\donatj\MDDoc\ElementFactory $documentationFactory, \donatj\MDDoc\Runner\TextUI $ui)](#mddoc-method-donatj-mddoc-runner-configparser-construct)
    - [function parse(string $filename): \donatj\MDDoc\Documentation\DocRoot](#mddoc-method-donatj-mddoc-runner-configparser-parse)
- [interface donatj\MDDoc\Runner\DocumentationOutputStrategy](#mddoc-interface-donatj-mddoc-runner-documentationoutputstrategy)
    - [function write(string $target, callable $render): bool](#mddoc-method-donatj-mddoc-runner-documentationoutputstrategy-write)
- [class donatj\MDDoc\Runner\DryRunDocumentationOutputStrategy](#mddoc-class-donatj-mddoc-runner-dryrundocumentationoutputstrategy)
    - [function write(string $target, callable $render): bool](#mddoc-method-donatj-mddoc-runner-dryrundocumentationoutputstrategy-write)
- [class donatj\MDDoc\Runner\FileDocumentationOutputStrategy](#mddoc-class-donatj-mddoc-runner-filedocumentationoutputstrategy)
    - [function __construct(\Psr\Log\LoggerInterface $logger)](#mddoc-method-donatj-mddoc-runner-filedocumentationoutputstrategy-construct)
    - [function write(string $target, callable $render): bool](#mddoc-method-donatj-mddoc-runner-filedocumentationoutputstrategy-write)
- [class donatj\MDDoc\Runner\ImmutableAttributeTree](#mddoc-class-donatj-mddoc-runner-immutableattributetree)
    - [function withAttr(array $attributes): self](#mddoc-method-donatj-mddoc-runner-immutableattributetree-withattr)
    - [function shallowValue(string $attr): ?string](#mddoc-method-donatj-mddoc-runner-immutableattributetree-shallowvalue)
    - [function deepValue(string $attr): ?string](#mddoc-method-donatj-mddoc-runner-immutableattributetree-deepvalue)
- [class donatj\MDDoc\Runner\TextUI](#mddoc-class-donatj-mddoc-runner-textui)
    - [function __construct($STDOUT, $STDERR)](#mddoc-method-donatj-mddoc-runner-textui-construct)
    - [function dumpOptions(string $additional): void](#mddoc-method-donatj-mddoc-runner-textui-dumpoptions)
    - [function dropError(string $text, int $code = 1, ?string $additional = null): void](#mddoc-method-donatj-mddoc-runner-textui-droperror)
    - [function println(string $text = ''): void](#mddoc-method-donatj-mddoc-runner-textui-println)
    - [function log($level, $message, array $context = []): void](#mddoc-method-donatj-mddoc-runner-textui-log)
    - [function emergency(string|\Stringable $message, array $context = []): void](#mddoc-method-donatj-mddoc-runner-textui-emergency)
    - [function alert(string|\Stringable $message, array $context = []): void](#mddoc-method-donatj-mddoc-runner-textui-alert)
    - [function critical(string|\Stringable $message, array $context = []): void](#mddoc-method-donatj-mddoc-runner-textui-critical)
    - [function error(string|\Stringable $message, array $context = []): void](#mddoc-method-donatj-mddoc-runner-textui-error)
    - [function warning(string|\Stringable $message, array $context = []): void](#mddoc-method-donatj-mddoc-runner-textui-warning)
    - [function notice(string|\Stringable $message, array $context = []): void](#mddoc-method-donatj-mddoc-runner-textui-notice)
    - [function info(string|\Stringable $message, array $context = []): void](#mddoc-method-donatj-mddoc-runner-textui-info)
    - [function debug(string|\Stringable $message, array $context = []): void](#mddoc-method-donatj-mddoc-runner-textui-debug)

## <a id="mddoc-class-donatj-mddoc-autoloaders-composerautoloader"></a>Class: donatj\MDDoc\Autoloaders\ComposerAutoloader

### <a id="mddoc-method-donatj-mddoc-autoloaders-composerautoloader-construct"></a>Method: ComposerAutoloader->__construct

```php
function __construct(\Composer\Autoload\ClassLoader $loader)
```

---

### <a id="mddoc-method-donatj-mddoc-autoloaders-composerautoloader-invoke"></a>Method: ComposerAutoloader->__invoke

```php
function __invoke(string $className): ?string
```

Locate the filename of a given class

#### Return Value

- ***string*** | ***null*** - Filename when the class is found, null otherwise

## <a id="mddoc-interface-donatj-mddoc-autoloaders-interfaces-autoloaderinterface"></a>Interface: donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface

### <a id="mddoc-method-donatj-mddoc-autoloaders-interfaces-autoloaderinterface-invoke"></a>Method: AutoloaderInterface->__invoke

```php
function __invoke(string $className): ?string
```

Locate the filename of a given class

#### Return Value

- ***string*** | ***null*** - Filename when the class is found, null otherwise

## <a id="mddoc-class-donatj-mddoc-autoloaders-multiloader"></a>Class: donatj\MDDoc\Autoloaders\MultiLoader

A simple autoloader chain

### <a id="mddoc-method-donatj-mddoc-autoloaders-multiloader-construct"></a>Method: MultiLoader->__construct

```php
function __construct(
	\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface ...$loaders,
)
```

---

### <a id="mddoc-method-donatj-mddoc-autoloaders-multiloader-invoke"></a>Method: MultiLoader->__invoke

```php
function __invoke(string $className): ?string
```

Locate the filename of a given class

#### Return Value

- ***string*** | ***null*** - Filename when the class is found, null otherwise

---

### <a id="mddoc-method-donatj-mddoc-autoloaders-multiloader-appendloader"></a>Method: MultiLoader->appendLoader

```php
function appendLoader(
	\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $loader,
): void
```

---

### <a id="mddoc-method-donatj-mddoc-autoloaders-multiloader-count"></a>Method: MultiLoader->count

```php
function count(): int
```

## <a id="mddoc-class-donatj-mddoc-autoloaders-nullloader"></a>Class: donatj\MDDoc\Autoloaders\NullLoader

### <a id="mddoc-method-donatj-mddoc-autoloaders-nullloader-invoke"></a>Method: NullLoader->__invoke

```php
function __invoke(string $className): ?string
```

Locate the filename of a given class

#### Return Value

- ***string*** | ***null*** - Filename when the class is found, null otherwise

## <a id="mddoc-class-donatj-mddoc-autoloaders-psr0"></a>Class: donatj\MDDoc\Autoloaders\Psr0

Class Psr0

### <a id="mddoc-method-donatj-mddoc-autoloaders-psr0-construct"></a>Method: Psr0->__construct

```php
function __construct(string $path)
```

#### Parameters

- ***string*** `$path` - Root path

---

### <a id="mddoc-method-donatj-mddoc-autoloaders-psr0-invoke"></a>Method: Psr0->__invoke

```php
function __invoke(string $className): ?string
```

Locate the filename of a given class

#### Return Value

- ***string*** | ***null*** - Filename when the class is found, null otherwise

## <a id="mddoc-class-donatj-mddoc-autoloaders-psr4"></a>Class: donatj\MDDoc\Autoloaders\Psr4

Class Psr4

### <a id="mddoc-method-donatj-mddoc-autoloaders-psr4-construct"></a>Method: Psr4->__construct

```php
function __construct(string $root_namespace, string $path)
```

#### Parameters

- ***string*** `$root_namespace` - Namespace prefix
- ***string*** `$path` - Root path

---

### <a id="mddoc-method-donatj-mddoc-autoloaders-psr4-invoke"></a>Method: Psr4->__invoke

```php
function __invoke(string $className): ?string
```

Locate the filename of a given class

#### Return Value

- ***string*** | ***null*** - Filename when the class is found, null otherwise

## <a id="mddoc-class-donatj-mddoc-documentation-abstractdocpart"></a>Class: donatj\MDDoc\Documentation\AbstractDocPart

### <a id="mddoc-method-donatj-mddoc-documentation-abstractdocpart-construct"></a>Method: AbstractDocPart->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-abstractdocpart-getparent"></a>Method: AbstractDocPart->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-abstractdocpart-gettextcontent"></a>Method: AbstractDocPart->getTextContent

```php
function getTextContent(): string
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-abstractdocpart-output"></a>Method: AbstractDocPart->output

```php
function output(int $depth)
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

## <a id="mddoc-class-donatj-mddoc-documentation-abstractelement"></a>Class: donatj\MDDoc\Documentation\AbstractElement

### <a id="mddoc-method-donatj-mddoc-documentation-abstractelement-construct"></a>Method: AbstractElement->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-abstractelement-getparent"></a>Method: AbstractElement->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-abstractelement-gettextcontent"></a>Method: AbstractElement->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-abstractnesteddoc"></a>Class: donatj\MDDoc\Documentation\AbstractNestedDoc

### <a id="mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-getchildren"></a>Method: AbstractNestedDoc->getChildren

```php
function getChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-getdocumentationchildren"></a>Method: AbstractNestedDoc->getDocumentationChildren

```php
function getDocumentationChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-addchildren"></a>Method: AbstractNestedDoc->addChildren

```php
function addChildren(
	\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children,
): void
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-construct"></a>Method: AbstractNestedDoc->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-getparent"></a>Method: AbstractNestedDoc->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-gettextcontent"></a>Method: AbstractNestedDoc->getTextContent

```php
function getTextContent(): string
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-output"></a>Method: AbstractNestedDoc->output

```php
function output(int $depth)
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

## <a id="mddoc-class-donatj-mddoc-documentation-autoloader"></a>Class: donatj\MDDoc\Documentation\Autoloader

```php
<?php
namespace donatj\MDDoc\Documentation;

class Autoloader {
	/** The type of autoloader to use: "composer", "psr0", or "psr4" */
	public const OPT_TYPE = 'type';
	/** The root directory of the autoloader, required for "psr0" and "psr4" */
	public const OPT_ROOT = 'root';
	/** The namespace of the autoloader, only used for psr4 */
	public const OPT_NAMESPACE = 'namespace';
}
```

### <a id="mddoc-method-donatj-mddoc-documentation-autoloader-construct"></a>Method: Autoloader->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-autoloader-gettype"></a>Method: Autoloader->getType

```php
function getType(): string
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-autoloader-getroot"></a>Method: Autoloader->getRoot

```php
function getRoot(): string
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-autoloader-getnamespace"></a>Method: Autoloader->getNamespace

```php
function getNamespace(): string
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-autoloader-getparent"></a>Method: Autoloader->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-autoloader-gettextcontent"></a>Method: Autoloader->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-badges-badge"></a>Class: donatj\MDDoc\Documentation\Badges\Badge

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

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badge-output"></a>Method: Badge->output

```php
function output(int $depth): string
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badge-construct"></a>Method: Badge->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badge-getparent"></a>Method: Badge->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badge-gettextcontent"></a>Method: Badge->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-badges-badgecoveralls"></a>Class: donatj\MDDoc\Documentation\Badges\BadgeCoveralls

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeCoveralls {
	/**
	 * The BadgeCoveralls name of the Project.
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

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-output"></a>Method: BadgeCoveralls->output

```php
function output(int $depth): string
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-construct"></a>Method: BadgeCoveralls->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-getparent"></a>Method: BadgeCoveralls->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-gettextcontent"></a>Method: BadgeCoveralls->getTextContent

```php
function getTextContent(): string
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-setlogger"></a>Method: BadgeCoveralls->setLogger

```php
function setLogger(\Psr\Log\LoggerInterface $logger): void
```

Sets a logger.

Sets a logger instance on the object.

## <a id="mddoc-class-donatj-mddoc-documentation-badges-badgegithubactions"></a>Class: donatj\MDDoc\Documentation\Badges\BadgeGitHubActions

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

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-output"></a>Method: BadgeGitHubActions->output

```php
function output(int $depth): string
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-construct"></a>Method: BadgeGitHubActions->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-getparent"></a>Method: BadgeGitHubActions->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-gettextcontent"></a>Method: BadgeGitHubActions->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-badges-badgeposer"></a>Class: donatj\MDDoc\Documentation\Badges\BadgePoser

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgePoser {
	/**
	 * The type of badge to display. One of: "version" "downloads" "unstable" "license" "monthly" "daily" "phpversion"
	 * "composerlock"
	 */
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

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgeposer-output"></a>Method: BadgePoser->output

```php
function output(int $depth): string
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgeposer-construct"></a>Method: BadgePoser->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgeposer-getparent"></a>Method: BadgePoser->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgeposer-gettextcontent"></a>Method: BadgePoser->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-badges-badgescrutinizer"></a>Class: donatj\MDDoc\Documentation\Badges\BadgeScrutinizer

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeScrutinizer {
	/**
	 * The packagist name of the Scrutinizer Project. Defaults to the name key of the composer.json file in the root of
	 * the project. Required if the composer.json file is not present.
	 */
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

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-output"></a>Method: BadgeScrutinizer->output

```php
function output(int $depth): string
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-construct"></a>Method: BadgeScrutinizer->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-getparent"></a>Method: BadgeScrutinizer->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-gettextcontent"></a>Method: BadgeScrutinizer->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-badges-badgeshielded"></a>Class: donatj\MDDoc\Documentation\Badges\BadgeShielded

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

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-output"></a>Method: BadgeShielded->output

```php
function output(int $depth): string
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-construct"></a>Method: BadgeShielded->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-getparent"></a>Method: BadgeShielded->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-gettextcontent"></a>Method: BadgeShielded->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-badges-badgetravis"></a>Class: donatj\MDDoc\Documentation\Badges\BadgeTravis

```php
<?php
namespace donatj\MDDoc\Documentation\Badges;

class BadgeTravis {
	/**
	 * The packagist name of the Travis Project. Defaults to the name key of the composer.json file in the root of the
	 * project. Required if the composer.json file is not present.
	 */
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

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgetravis-output"></a>Method: BadgeTravis->output

```php
function output(int $depth): string
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgetravis-construct"></a>Method: BadgeTravis->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgetravis-getparent"></a>Method: BadgeTravis->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-badges-badgetravis-gettextcontent"></a>Method: BadgeTravis->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-composerinstall"></a>Class: donatj\MDDoc\Documentation\ComposerInstall

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

### <a id="mddoc-method-donatj-mddoc-documentation-composerinstall-output"></a>Method: ComposerInstall->output

```php
function output(int $depth): \donatj\MDDom\Paragraph
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-composerinstall-construct"></a>Method: ComposerInstall->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-composerinstall-getparent"></a>Method: ComposerInstall->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-composerinstall-gettextcontent"></a>Method: ComposerInstall->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-composerrequires"></a>Class: donatj\MDDoc\Documentation\ComposerRequires

### <a id="mddoc-method-donatj-mddoc-documentation-composerrequires-output"></a>Method: ComposerRequires->output

```php
function output(int $depth): \donatj\MDDom\Paragraph
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-composerrequires-construct"></a>Method: ComposerRequires->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-composerrequires-getparent"></a>Method: ComposerRequires->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-composerrequires-gettextcontent"></a>Method: ComposerRequires->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-docpage"></a>Class: donatj\MDDoc\Documentation\DocPage

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

### <a id="mddoc-method-donatj-mddoc-documentation-docpage-output"></a>Method: DocPage->output

```php
function output(int $depth): string
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-docpage-setdocumentationoutputstrategy"></a>Method: DocPage->setDocumentationOutputStrategy

```php
function setDocumentationOutputStrategy(
	\donatj\MDDoc\Runner\DocumentationOutputStrategy $documentationOutputStrategy,
): void
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-docpage-getchildren"></a>Method: DocPage->getChildren

```php
function getChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-docpage-getdocumentationchildren"></a>Method: DocPage->getDocumentationChildren

```php
function getDocumentationChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-docpage-addchildren"></a>Method: DocPage->addChildren

```php
function addChildren(
	\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children,
): void
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-docpage-construct"></a>Method: DocPage->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-docpage-getparent"></a>Method: DocPage->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-docpage-gettextcontent"></a>Method: DocPage->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-docroot"></a>Class: donatj\MDDoc\Documentation\DocRoot

### <a id="mddoc-method-donatj-mddoc-documentation-docroot-output"></a>Method: DocRoot->output

```php
function output(int $depth)
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-docroot-getchildren"></a>Method: DocRoot->getChildren

```php
function getChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-docroot-getdocumentationchildren"></a>Method: DocRoot->getDocumentationChildren

```php
function getDocumentationChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-docroot-addchildren"></a>Method: DocRoot->addChildren

```php
function addChildren(
	\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children,
): void
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-docroot-construct"></a>Method: DocRoot->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-docroot-getparent"></a>Method: DocRoot->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-docroot-gettextcontent"></a>Method: DocRoot->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-exceptions-executionexception"></a>Class: donatj\MDDoc\Documentation\Exceptions\ExecutionException

## <a id="mddoc-class-donatj-mddoc-documentation-exceptions-unhandledconfigtagexception"></a>Class: donatj\MDDoc\Documentation\Exceptions\UnhandledConfigTagException

## <a id="mddoc-class-donatj-mddoc-documentation-execoutput"></a>Class: donatj\MDDoc\Documentation\ExecOutput

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

### <a id="mddoc-method-donatj-mddoc-documentation-execoutput-output"></a>Method: ExecOutput->output

```php
function output(int $depth): \donatj\MDDom\AbstractElement
```

**Throws**: `\donatj\MDDoc\Exceptions\ConfigException`

**Throws**: `\donatj\MDDoc\Documentation\Exceptions\ExecutionException`

---

### <a id="mddoc-method-donatj-mddoc-documentation-execoutput-construct"></a>Method: ExecOutput->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-execoutput-getparent"></a>Method: ExecOutput->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-execoutput-gettextcontent"></a>Method: ExecOutput->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-includefile"></a>Class: donatj\MDDoc\Documentation\IncludeFile

```php
<?php
namespace donatj\MDDoc\Documentation;

class IncludeFile {
	/** The poth of the file to include */
	public const OPT_NAME = 'name';
}
```

### <a id="mddoc-method-donatj-mddoc-documentation-includefile-output"></a>Method: IncludeFile->output

```php
function output(int $depth): \donatj\MDDom\Paragraph
```

**Throws**: `\donatj\MDDoc\Exceptions\PathNotReadableException`

---

### <a id="mddoc-method-donatj-mddoc-documentation-includefile-construct"></a>Method: IncludeFile->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-includefile-getparent"></a>Method: IncludeFile->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-includefile-gettextcontent"></a>Method: IncludeFile->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-interface-donatj-mddoc-documentation-interfaces-autoloaderaware"></a>Interface: donatj\MDDoc\Documentation\Interfaces\AutoloaderAware

### <a id="mddoc-method-donatj-mddoc-documentation-interfaces-autoloaderaware-setautoloader"></a>Method: AutoloaderAware->setAutoloader

```php
function setAutoloader(
	\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader,
): void
```

## <a id="mddoc-interface-donatj-mddoc-documentation-interfaces-documentationinterface"></a>Interface: donatj\MDDoc\Documentation\Interfaces\DocumentationInterface

### <a id="mddoc-method-donatj-mddoc-documentation-interfaces-documentationinterface-output"></a>Method: DocumentationInterface->output

```php
function output(int $depth)
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-interfaces-documentationinterface-construct"></a>Method: DocumentationInterface->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent,
)
```

## <a id="mddoc-interface-donatj-mddoc-documentation-interfaces-documentationoutputstrategyaware"></a>Interface: donatj\MDDoc\Documentation\Interfaces\DocumentationOutputStrategyAware

### <a id="mddoc-method-donatj-mddoc-documentation-interfaces-documentationoutputstrategyaware-setdocumentationoutputstrategy"></a>Method: DocumentationOutputStrategyAware->setDocumentationOutputStrategy

```php
function setDocumentationOutputStrategy(
	\donatj\MDDoc\Runner\DocumentationOutputStrategy $documentationOutputStrategy,
): void
```

## <a id="mddoc-interface-donatj-mddoc-documentation-interfaces-elementinterface"></a>Interface: donatj\MDDoc\Documentation\Interfaces\ElementInterface

### <a id="mddoc-method-donatj-mddoc-documentation-interfaces-elementinterface-construct"></a>Method: ElementInterface->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent,
)
```

## <a id="mddoc-class-donatj-mddoc-documentation-phpfiledocs"></a>Class: donatj\MDDoc\Documentation\PhpFileDocs

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
	/** Maximum signature length before wrapping. Defaults to 80. Set to 0 to disable wrapping. */
	public const OPT_SIGNATURE_WRAP_LENGTH = 'signature-wrap-length';
}
```

### <a id="mddoc-method-donatj-mddoc-documentation-phpfiledocs-output"></a>Method: PhpFileDocs->output

```php
function output(int $depth)
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string***

---

### <a id="mddoc-method-donatj-mddoc-documentation-phpfiledocs-setautoloader"></a>Method: PhpFileDocs->setAutoloader

```php
function setAutoloader(
	\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader,
): void
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-phpfiledocs-construct"></a>Method: PhpFileDocs->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-phpfiledocs-getparent"></a>Method: PhpFileDocs->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-phpfiledocs-gettextcontent"></a>Method: PhpFileDocs->getTextContent

```php
function getTextContent(): string
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-phpfiledocs-setlogger"></a>Method: PhpFileDocs->setLogger

```php
function setLogger(\Psr\Log\LoggerInterface $logger): void
```

Sets a logger.

Sets a logger instance on the object.

## <a id="mddoc-class-donatj-mddoc-documentation-recursivedirectory"></a>Class: donatj\MDDoc\Documentation\RecursiveDirectory

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

### <a id="mddoc-method-donatj-mddoc-documentation-recursivedirectory-setautoloader"></a>Method: RecursiveDirectory->setAutoloader

```php
function setAutoloader(
	\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoloader,
): void
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-recursivedirectory-output"></a>Method: RecursiveDirectory->output

```php
function output(int $depth): \donatj\MDDom\Document
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-recursivedirectory-getchildren"></a>Method: RecursiveDirectory->getChildren

```php
function getChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-recursivedirectory-getdocumentationchildren"></a>Method: RecursiveDirectory->getDocumentationChildren

```php
function getDocumentationChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-recursivedirectory-addchildren"></a>Method: RecursiveDirectory->addChildren

```php
function addChildren(
	\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children,
): void
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-recursivedirectory-construct"></a>Method: RecursiveDirectory->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-recursivedirectory-getparent"></a>Method: RecursiveDirectory->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-recursivedirectory-gettextcontent"></a>Method: RecursiveDirectory->getTextContent

```php
function getTextContent(): string
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-recursivedirectory-setlogger"></a>Method: RecursiveDirectory->setLogger

```php
function setLogger(\Psr\Log\LoggerInterface $logger): void
```

Sets a logger.

Sets a logger instance on the object.

## <a id="mddoc-class-donatj-mddoc-documentation-replace"></a>Class: donatj\MDDoc\Documentation\Replace

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

### <a id="mddoc-method-donatj-mddoc-documentation-replace-output"></a>Method: Replace->output

```php
function output(int $depth): string
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-replace-getchildren"></a>Method: Replace->getChildren

```php
function getChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-replace-getdocumentationchildren"></a>Method: Replace->getDocumentationChildren

```php
function getDocumentationChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-replace-addchildren"></a>Method: Replace->addChildren

```php
function addChildren(
	\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children,
): void
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-replace-construct"></a>Method: Replace->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-replace-getparent"></a>Method: Replace->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-replace-gettextcontent"></a>Method: Replace->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-section"></a>Class: donatj\MDDoc\Documentation\Section

```php
<?php
namespace donatj\MDDoc\Documentation;

class Section {
	/** The heading of the section */
	public const OPT_TITLE = 'title';
}
```

### <a id="mddoc-method-donatj-mddoc-documentation-section-output"></a>Method: Section->output

```php
function output(int $depth): \donatj\MDDom\DocumentDepth
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-section-getchildren"></a>Method: Section->getChildren

```php
function getChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\ElementInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-section-getdocumentationchildren"></a>Method: Section->getDocumentationChildren

```php
function getDocumentationChildren(): array
```

#### Return Value

- ***\donatj\MDDoc\Documentation\Interfaces\DocumentationInterface[]***

---

### <a id="mddoc-method-donatj-mddoc-documentation-section-addchildren"></a>Method: Section->addChildren

```php
function addChildren(
	\donatj\MDDoc\Documentation\Interfaces\ElementInterface ...$children,
): void
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-section-construct"></a>Method: Section->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-section-getparent"></a>Method: Section->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-section-gettextcontent"></a>Method: Section->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-source"></a>Class: donatj\MDDoc\Documentation\Source

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

### <a id="mddoc-method-donatj-mddoc-documentation-source-output"></a>Method: Source->output

```php
function output(int $depth): \donatj\MDDom\AbstractElement
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-source-construct"></a>Method: Source->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-source-getparent"></a>Method: Source->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-source-gettextcontent"></a>Method: Source->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-documentation-text"></a>Class: donatj\MDDoc\Documentation\Text

### <a id="mddoc-method-donatj-mddoc-documentation-text-output"></a>Method: Text->output

```php
function output(int $depth): \donatj\MDDom\AbstractElement
```

#### Return Value

- ***\donatj\MDDom\AbstractElement*** | ***string*** | ***void*** - Cannot be annotated as also accepts __toString-able objects

---

### <a id="mddoc-method-donatj-mddoc-documentation-text-construct"></a>Method: Text->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent = '',
)
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-text-getparent"></a>Method: Text->getParent

```php
function getParent(): ?\donatj\MDDoc\Documentation\AbstractDocPart
```

---

### <a id="mddoc-method-donatj-mddoc-documentation-text-gettextcontent"></a>Method: Text->getTextContent

```php
function getTextContent(): string
```

## <a id="mddoc-class-donatj-mddoc-elementfactory"></a>Class: donatj\MDDoc\ElementFactory

Links XML Tags to their Given Documentation Generator

```php
<?php
namespace donatj\MDDoc;

class ElementFactory {
	public const DEFAULT_ELEMENTS = [\donatj\MDDoc\Documentation\Autoloader::class, \donatj\MDDoc\Documentation\Section::class, \donatj\MDDoc\Documentation\Replace::class, \donatj\MDDoc\Documentation\DocPage::class, \donatj\MDDoc\Documentation\Text::class, \donatj\MDDoc\Documentation\PhpFileDocs::class, \donatj\MDDoc\Documentation\RecursiveDirectory::class, \donatj\MDDoc\Documentation\IncludeFile::class, \donatj\MDDoc\Documentation\Source::class, \donatj\MDDoc\Documentation\ComposerInstall::class, \donatj\MDDoc\Documentation\ComposerRequires::class, \donatj\MDDoc\Documentation\Badges\Badge::class, \donatj\MDDoc\Documentation\Badges\BadgeCoveralls::class, \donatj\MDDoc\Documentation\Badges\BadgePoser::class, \donatj\MDDoc\Documentation\Badges\BadgeTravis::class, \donatj\MDDoc\Documentation\Badges\BadgeScrutinizer::class, \donatj\MDDoc\Documentation\Badges\BadgeShielded::class, \donatj\MDDoc\Documentation\Badges\BadgeGitHubActions::class, \donatj\MDDoc\Documentation\ExecOutput::class];
}
```

### <a id="mddoc-method-donatj-mddoc-elementfactory-construct"></a>Method: ElementFactory->__construct

```php
function __construct(
	\donatj\MDDoc\Runner\TextUI $ui,
	\donatj\MDDoc\Runner\DocumentationOutputStrategy $documentationOutputStrategy,
)
```

ElementFactory constructor.

---

### <a id="mddoc-method-donatj-mddoc-elementfactory-makefromtag"></a>Method: ElementFactory->makeFromTag

```php
function makeFromTag(
	string $tagName,
	\donatj\MDDoc\Runner\ImmutableAttributeTree $attributeTree,
	string $textContent,
): \donatj\MDDoc\Documentation\Interfaces\ElementInterface
```

Return a populated DocumentationInterface of the corresponding tagName

## <a id="mddoc-class-donatj-mddoc-exceptions-classnotreadableexception"></a>Class: donatj\MDDoc\Exceptions\ClassNotReadableException

### <a id="mddoc-method-donatj-mddoc-exceptions-classnotreadableexception-construct"></a>Method: ClassNotReadableException->__construct

```php
function __construct(
	string $message,
	string $path,
	?\Exception $previous_exception = null,
)
```

---

### <a id="mddoc-method-donatj-mddoc-exceptions-classnotreadableexception-getpath"></a>Method: ClassNotReadableException->getPath

```php
function getPath(): string
```

## <a id="mddoc-class-donatj-mddoc-exceptions-configexception"></a>Class: donatj\MDDoc\Exceptions\ConfigException

## <a id="mddoc-class-donatj-mddoc-exceptions-dryrunmismatchexception"></a>Class: donatj\MDDoc\Exceptions\DryRunMismatchException

### <a id="mddoc-method-donatj-mddoc-exceptions-dryrunmismatchexception-construct"></a>Method: DryRunMismatchException->__construct

```php
function __construct(string $target)
```

---

### <a id="mddoc-method-donatj-mddoc-exceptions-dryrunmismatchexception-gettarget"></a>Method: DryRunMismatchException->getTarget

```php
function getTarget(): string
```

## <a id="mddoc-class-donatj-mddoc-exceptions-mddocexception"></a>Class: donatj\MDDoc\Exceptions\MDDocException

## <a id="mddoc-class-donatj-mddoc-exceptions-pathnotreadableexception"></a>Class: donatj\MDDoc\Exceptions\PathNotReadableException

### <a id="mddoc-method-donatj-mddoc-exceptions-pathnotreadableexception-construct"></a>Method: PathNotReadableException->__construct

```php
function __construct(
	string $message,
	string $path,
	?\Exception $previous_exception = null,
)
```

---

### <a id="mddoc-method-donatj-mddoc-exceptions-pathnotreadableexception-getpath"></a>Method: PathNotReadableException->getPath

```php
function getPath(): string
```

## <a id="mddoc-class-donatj-mddoc-exceptions-targetnotwritableexception"></a>Class: donatj\MDDoc\Exceptions\TargetNotWritableException

## <a id="mddoc-class-donatj-mddoc-mddoc"></a>Class: donatj\MDDoc\MDDoc

Application MDDoc

### <a id="mddoc-method-donatj-mddoc-mddoc-construct"></a>Method: MDDoc->__construct

```php
function __construct(array $args)
```

#### Parameters

- ***string[]*** `$args`

## <a id="mddoc-class-donatj-mddoc-reflectors-taxonomyreflector"></a>Class: donatj\MDDoc\Reflectors\TaxonomyReflector

### <a id="mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-construct"></a>Method: TaxonomyReflector->__construct

```php
function __construct(
	string $filename,
	\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader,
	\donatj\MDDoc\Reflectors\TaxonomyReflectorFactory $parserFactory,
)
```

**Throws**: `\donatj\MDDoc\Exceptions\ClassNotReadableException`

---

### <a id="mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getreflector"></a>Method: TaxonomyReflector->getReflector

```php
function getReflector(): ?\donatj\MDDoc\Reflectors\Source\Element
```

Returns the source class, interface, or trait declaration.

---

### <a id="mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getdocmethods"></a>Method: TaxonomyReflector->getDocMethods

```php
function getDocMethods(): array
```

#### Return Value

- ***array<string,list<\donatj\MDDoc\Reflectors\Source\Tag>>***

---

### <a id="mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getmethods"></a>Method: TaxonomyReflector->getMethods

```php
function getMethods(): array
```

#### Return Value

- ***array<string,list<\donatj\MDDoc\Reflectors\Source\Element>>***

---

### <a id="mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getconstants"></a>Method: TaxonomyReflector->getConstants

```php
function getConstants(): array
```

#### Return Value

- ***array<string,list<\donatj\MDDoc\Reflectors\Source\Element>>***

---

### <a id="mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getproperties"></a>Method: TaxonomyReflector->getProperties

```php
function getProperties(): array
```

#### Return Value

- ***array<string,list<\donatj\MDDoc\Reflectors\Source\Element>>***

---

### <a id="mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getfunctions"></a>Method: TaxonomyReflector->getFunctions

```php
function getFunctions(): array
```

#### Return Value

- ***array<string,\donatj\MDDoc\Reflectors\Source\Element>***

## <a id="mddoc-class-donatj-mddoc-reflectors-taxonomyreflectorfactory"></a>Class: donatj\MDDoc\Reflectors\TaxonomyReflectorFactory

### <a id="mddoc-method-donatj-mddoc-reflectors-taxonomyreflectorfactory-newinstance"></a>Method: TaxonomyReflectorFactory->newInstance

```php
function newInstance(
	string $filename,
	\donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface $autoLoader,
): \donatj\MDDoc\Reflectors\TaxonomyReflector
```

**Throws**: `\donatj\MDDoc\Exceptions\ClassNotReadableException`

## <a id="mddoc-class-donatj-mddoc-runner-configparser"></a>Class: donatj\MDDoc\Runner\ConfigParser

### <a id="mddoc-method-donatj-mddoc-runner-configparser-construct"></a>Method: ConfigParser->__construct

```php
function __construct(
	\donatj\MDDoc\ElementFactory $documentationFactory,
	\donatj\MDDoc\Runner\TextUI $ui,
)
```

---

### <a id="mddoc-method-donatj-mddoc-runner-configparser-parse"></a>Method: ConfigParser->parse

```php
function parse(string $filename): \donatj\MDDoc\Documentation\DocRoot
```

Parse a config file

**Throws**: `\donatj\MDDoc\Exceptions\ConfigException`

#### Return Value

- ***\donatj\MDDoc\Documentation\DocRoot***

## <a id="mddoc-interface-donatj-mddoc-runner-documentationoutputstrategy"></a>Interface: donatj\MDDoc\Runner\DocumentationOutputStrategy

### <a id="mddoc-method-donatj-mddoc-runner-documentationoutputstrategy-write"></a>Method: DocumentationOutputStrategy->write

```php
function write(string $target, callable $render): bool
```

#### Parameters

- ***callable(): string*** `$render`

## <a id="mddoc-class-donatj-mddoc-runner-dryrundocumentationoutputstrategy"></a>Class: donatj\MDDoc\Runner\DryRunDocumentationOutputStrategy

### <a id="mddoc-method-donatj-mddoc-runner-dryrundocumentationoutputstrategy-write"></a>Method: DryRunDocumentationOutputStrategy->write

```php
function write(string $target, callable $render): bool
```

#### Parameters

- ***callable(): string*** `$render`

## <a id="mddoc-class-donatj-mddoc-runner-filedocumentationoutputstrategy"></a>Class: donatj\MDDoc\Runner\FileDocumentationOutputStrategy

### <a id="mddoc-method-donatj-mddoc-runner-filedocumentationoutputstrategy-construct"></a>Method: FileDocumentationOutputStrategy->__construct

```php
function __construct(\Psr\Log\LoggerInterface $logger)
```

---

### <a id="mddoc-method-donatj-mddoc-runner-filedocumentationoutputstrategy-write"></a>Method: FileDocumentationOutputStrategy->write

```php
function write(string $target, callable $render): bool
```

#### Parameters

- ***callable(): string*** `$render`

## <a id="mddoc-class-donatj-mddoc-runner-immutableattributetree"></a>Class: donatj\MDDoc\Runner\ImmutableAttributeTree

ImmutableAttributeTree is a helper for reading XML Attributes

### <a id="mddoc-method-donatj-mddoc-runner-immutableattributetree-withattr"></a>Method: ImmutableAttributeTree->withAttr

```php
function withAttr(array $attributes): self
```

Returns a clone of this ImmutableAttributeTree with another depth of attributes appended.

#### Parameters

- ***array<string,string>*** `$attributes`

#### Return Value

- ***static*** - Clone of current ImmutableAttributeTree

---

### <a id="mddoc-method-donatj-mddoc-runner-immutableattributetree-shallowvalue"></a>Method: ImmutableAttributeTree->shallowValue

```php
function shallowValue(string $attr): ?string
```

Fetch an attribute value by key from the top-most element.

#### Return Value

- ***string*** | ***null*** - Returns null on not found.

---

### <a id="mddoc-method-donatj-mddoc-runner-immutableattributetree-deepvalue"></a>Method: ImmutableAttributeTree->deepValue

```php
function deepValue(string $attr): ?string
```

Fetch the first attribute value by key from the starting with the top-most element and working up to the root.

#### Return Value

- ***string*** | ***null*** - Returns null on not found.

## <a id="mddoc-class-donatj-mddoc-runner-textui"></a>Class: donatj\MDDoc\Runner\TextUI

### <a id="mddoc-method-donatj-mddoc-runner-textui-construct"></a>Method: TextUI->__construct

```php
function __construct($STDOUT, $STDERR)
```

UserInterface constructor.

#### Parameters

- ***resource*** `$STDOUT`
- ***resource*** `$STDERR`

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-dumpoptions"></a>Method: TextUI->dumpOptions

```php
function dumpOptions(string $additional): void
```

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-droperror"></a>Method: TextUI->dropError

```php
function dropError(
	string $text,
	int $code = 1,
	?string $additional = null,
): void
```

Output an Error before exiting with given error code

#### Parameters

- ***string*** `$text` - Primary error log details
- ***int*** `$code` - Status code to exit with (0-255)
- ***string*** | ***null*** `$additional` - Optional - will print on a second line following the log

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-println"></a>Method: TextUI->println

```php
function println(string $text = ''): void
```

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-log"></a>Method: TextUI->log

```php
function log($level, $message, array $context = []): void
```

Logs with an arbitrary level.

Logs with an arbitrary level.

#### Parameters

- ***mixed*** `$level`

**Throws**: `\Psr\Log\InvalidArgumentException`

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-emergency"></a>Method: TextUI->emergency

```php
function emergency(string|\Stringable $message, array $context = []): void
```

System is unusable.

System is unusable.

#### Parameters

- ***mixed[]*** `$context`

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-alert"></a>Method: TextUI->alert

```php
function alert(string|\Stringable $message, array $context = []): void
```

Action must be taken immediately.  
  
Example: Entire website down, database unavailable, etc. This should  
trigger the SMS alerts and wake you up.

Action must be taken immediately.  
  
Example: Entire website down, database unavailable, etc. This should  
trigger the SMS alerts and wake you up.

#### Parameters

- ***mixed[]*** `$context`

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-critical"></a>Method: TextUI->critical

```php
function critical(string|\Stringable $message, array $context = []): void
```

Critical conditions.  
  
Example: Application component unavailable, unexpected exception.

Critical conditions.  
  
Example: Application component unavailable, unexpected exception.

#### Parameters

- ***mixed[]*** `$context`

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-error"></a>Method: TextUI->error

```php
function error(string|\Stringable $message, array $context = []): void
```

Runtime errors that do not require immediate action but should typically  
be logged and monitored.

Runtime errors that do not require immediate action but should typically  
be logged and monitored.

#### Parameters

- ***mixed[]*** `$context`

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-warning"></a>Method: TextUI->warning

```php
function warning(string|\Stringable $message, array $context = []): void
```

Exceptional occurrences that are not errors.  
  
Example: Use of deprecated APIs, poor use of an API, undesirable things  
that are not necessarily wrong.

Exceptional occurrences that are not errors.  
  
Example: Use of deprecated APIs, poor use of an API, undesirable things  
that are not necessarily wrong.

#### Parameters

- ***mixed[]*** `$context`

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-notice"></a>Method: TextUI->notice

```php
function notice(string|\Stringable $message, array $context = []): void
```

Normal but significant events.

Normal but significant events.

#### Parameters

- ***mixed[]*** `$context`

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-info"></a>Method: TextUI->info

```php
function info(string|\Stringable $message, array $context = []): void
```

Interesting events.  
  
Example: User logs in, SQL logs.

Interesting events.  
  
Example: User logs in, SQL logs.

#### Parameters

- ***mixed[]*** `$context`

---

### <a id="mddoc-method-donatj-mddoc-runner-textui-debug"></a>Method: TextUI->debug

```php
function debug(string|\Stringable $message, array $context = []): void
```

Detailed debug information.

Detailed debug information.

#### Parameters

- ***mixed[]*** `$context`