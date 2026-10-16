# Full API Docs (WIP)

Set `table-of-contents="true"` on a `recursive-directory` to link documented types and methods.

## Table of Contents

- [Class: donatj\MDDoc\Autoloaders\ComposerAutoloader](#mddoc-class-donatj-mddoc-autoloaders-composerautoloader)
    - [Method: ComposerAutoloader->__construct](#mddoc-method-donatj-mddoc-autoloaders-composerautoloader-construct)
    - [Method: ComposerAutoloader->__invoke](#mddoc-method-donatj-mddoc-autoloaders-composerautoloader-invoke)
- [Interface: donatj\MDDoc\Autoloaders\Interfaces\AutoloaderInterface](#mddoc-interface-donatj-mddoc-autoloaders-interfaces-autoloaderinterface)
    - [Method: AutoloaderInterface->__invoke](#mddoc-method-donatj-mddoc-autoloaders-interfaces-autoloaderinterface-invoke)
- [Class: donatj\MDDoc\Autoloaders\MultiLoader](#mddoc-class-donatj-mddoc-autoloaders-multiloader)
    - [Method: MultiLoader->__construct](#mddoc-method-donatj-mddoc-autoloaders-multiloader-construct)
    - [Method: MultiLoader->__invoke](#mddoc-method-donatj-mddoc-autoloaders-multiloader-invoke)
    - [Method: MultiLoader->appendLoader](#mddoc-method-donatj-mddoc-autoloaders-multiloader-appendloader)
    - [Method: MultiLoader->count](#mddoc-method-donatj-mddoc-autoloaders-multiloader-count)
- [Class: donatj\MDDoc\Autoloaders\NullLoader](#mddoc-class-donatj-mddoc-autoloaders-nullloader)
    - [Method: NullLoader->__invoke](#mddoc-method-donatj-mddoc-autoloaders-nullloader-invoke)
- [Class: donatj\MDDoc\Autoloaders\Psr0](#mddoc-class-donatj-mddoc-autoloaders-psr0)
    - [Method: Psr0->__construct](#mddoc-method-donatj-mddoc-autoloaders-psr0-construct)
    - [Method: Psr0->__invoke](#mddoc-method-donatj-mddoc-autoloaders-psr0-invoke)
- [Class: donatj\MDDoc\Autoloaders\Psr4](#mddoc-class-donatj-mddoc-autoloaders-psr4)
    - [Method: Psr4->__construct](#mddoc-method-donatj-mddoc-autoloaders-psr4-construct)
    - [Method: Psr4->__invoke](#mddoc-method-donatj-mddoc-autoloaders-psr4-invoke)
- [Class: donatj\MDDoc\Documentation\AbstractDocPart](#mddoc-class-donatj-mddoc-documentation-abstractdocpart)
    - [Method: AbstractDocPart->__construct](#mddoc-method-donatj-mddoc-documentation-abstractdocpart-construct)
    - [Method: AbstractDocPart->getParent](#mddoc-method-donatj-mddoc-documentation-abstractdocpart-getparent)
    - [Method: AbstractDocPart->getTextContent](#mddoc-method-donatj-mddoc-documentation-abstractdocpart-gettextcontent)
    - [Method: AbstractDocPart->output](#mddoc-method-donatj-mddoc-documentation-abstractdocpart-output)
- [Class: donatj\MDDoc\Documentation\AbstractElement](#mddoc-class-donatj-mddoc-documentation-abstractelement)
    - [Method: AbstractElement->__construct](#mddoc-method-donatj-mddoc-documentation-abstractelement-construct)
    - [Method: AbstractElement->getParent](#mddoc-method-donatj-mddoc-documentation-abstractelement-getparent)
    - [Method: AbstractElement->getTextContent](#mddoc-method-donatj-mddoc-documentation-abstractelement-gettextcontent)
- [Class: donatj\MDDoc\Documentation\AbstractNestedDoc](#mddoc-class-donatj-mddoc-documentation-abstractnesteddoc)
    - [Method: AbstractNestedDoc->getChildren](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-getchildren)
    - [Method: AbstractNestedDoc->getDocumentationChildren](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-getdocumentationchildren)
    - [Method: AbstractNestedDoc->addChildren](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-addchildren)
    - [Method: AbstractNestedDoc->__construct](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-construct)
    - [Method: AbstractNestedDoc->getParent](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-getparent)
    - [Method: AbstractNestedDoc->getTextContent](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-gettextcontent)
    - [Method: AbstractNestedDoc->output](#mddoc-method-donatj-mddoc-documentation-abstractnesteddoc-output)
- [Class: donatj\MDDoc\Documentation\Autoloader](#mddoc-class-donatj-mddoc-documentation-autoloader)
    - [Method: Autoloader->__construct](#mddoc-method-donatj-mddoc-documentation-autoloader-construct)
    - [Method: Autoloader->getType](#mddoc-method-donatj-mddoc-documentation-autoloader-gettype)
    - [Method: Autoloader->getRoot](#mddoc-method-donatj-mddoc-documentation-autoloader-getroot)
    - [Method: Autoloader->getNamespace](#mddoc-method-donatj-mddoc-documentation-autoloader-getnamespace)
    - [Method: Autoloader->getParent](#mddoc-method-donatj-mddoc-documentation-autoloader-getparent)
    - [Method: Autoloader->getTextContent](#mddoc-method-donatj-mddoc-documentation-autoloader-gettextcontent)
- [Class: donatj\MDDoc\Documentation\Badges\Badge](#mddoc-class-donatj-mddoc-documentation-badges-badge)
    - [Method: Badge->output](#mddoc-method-donatj-mddoc-documentation-badges-badge-output)
    - [Method: Badge->__construct](#mddoc-method-donatj-mddoc-documentation-badges-badge-construct)
    - [Method: Badge->getParent](#mddoc-method-donatj-mddoc-documentation-badges-badge-getparent)
    - [Method: Badge->getTextContent](#mddoc-method-donatj-mddoc-documentation-badges-badge-gettextcontent)
- [Class: donatj\MDDoc\Documentation\Badges\BadgeCoveralls](#mddoc-class-donatj-mddoc-documentation-badges-badgecoveralls)
    - [Method: BadgeCoveralls->output](#mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-output)
    - [Method: BadgeCoveralls->__construct](#mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-construct)
    - [Method: BadgeCoveralls->getParent](#mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-getparent)
    - [Method: BadgeCoveralls->getTextContent](#mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-gettextcontent)
    - [Method: BadgeCoveralls->setLogger](#mddoc-method-donatj-mddoc-documentation-badges-badgecoveralls-setlogger)
- [Class: donatj\MDDoc\Documentation\Badges\BadgeGitHubActions](#mddoc-class-donatj-mddoc-documentation-badges-badgegithubactions)
    - [Method: BadgeGitHubActions->output](#mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-output)
    - [Method: BadgeGitHubActions->__construct](#mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-construct)
    - [Method: BadgeGitHubActions->getParent](#mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-getparent)
    - [Method: BadgeGitHubActions->getTextContent](#mddoc-method-donatj-mddoc-documentation-badges-badgegithubactions-gettextcontent)
- [Class: donatj\MDDoc\Documentation\Badges\BadgePoser](#mddoc-class-donatj-mddoc-documentation-badges-badgeposer)
    - [Method: BadgePoser->output](#mddoc-method-donatj-mddoc-documentation-badges-badgeposer-output)
    - [Method: BadgePoser->__construct](#mddoc-method-donatj-mddoc-documentation-badges-badgeposer-construct)
    - [Method: BadgePoser->getParent](#mddoc-method-donatj-mddoc-documentation-badges-badgeposer-getparent)
    - [Method: BadgePoser->getTextContent](#mddoc-method-donatj-mddoc-documentation-badges-badgeposer-gettextcontent)
- [Class: donatj\MDDoc\Documentation\Badges\BadgeScrutinizer](#mddoc-class-donatj-mddoc-documentation-badges-badgescrutinizer)
    - [Method: BadgeScrutinizer->output](#mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-output)
    - [Method: BadgeScrutinizer->__construct](#mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-construct)
    - [Method: BadgeScrutinizer->getParent](#mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-getparent)
    - [Method: BadgeScrutinizer->getTextContent](#mddoc-method-donatj-mddoc-documentation-badges-badgescrutinizer-gettextcontent)
- [Class: donatj\MDDoc\Documentation\Badges\BadgeShielded](#mddoc-class-donatj-mddoc-documentation-badges-badgeshielded)
    - [Method: BadgeShielded->output](#mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-output)
    - [Method: BadgeShielded->__construct](#mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-construct)
    - [Method: BadgeShielded->getParent](#mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-getparent)
    - [Method: BadgeShielded->getTextContent](#mddoc-method-donatj-mddoc-documentation-badges-badgeshielded-gettextcontent)
- [Class: donatj\MDDoc\Documentation\Badges\BadgeTravis](#mddoc-class-donatj-mddoc-documentation-badges-badgetravis)
    - [Method: BadgeTravis->output](#mddoc-method-donatj-mddoc-documentation-badges-badgetravis-output)
    - [Method: BadgeTravis->__construct](#mddoc-method-donatj-mddoc-documentation-badges-badgetravis-construct)
    - [Method: BadgeTravis->getParent](#mddoc-method-donatj-mddoc-documentation-badges-badgetravis-getparent)
    - [Method: BadgeTravis->getTextContent](#mddoc-method-donatj-mddoc-documentation-badges-badgetravis-gettextcontent)
- [Class: donatj\MDDoc\Documentation\ComposerInstall](#mddoc-class-donatj-mddoc-documentation-composerinstall)
    - [Method: ComposerInstall->output](#mddoc-method-donatj-mddoc-documentation-composerinstall-output)
    - [Method: ComposerInstall->__construct](#mddoc-method-donatj-mddoc-documentation-composerinstall-construct)
    - [Method: ComposerInstall->getParent](#mddoc-method-donatj-mddoc-documentation-composerinstall-getparent)
    - [Method: ComposerInstall->getTextContent](#mddoc-method-donatj-mddoc-documentation-composerinstall-gettextcontent)
- [Class: donatj\MDDoc\Documentation\ComposerRequires](#mddoc-class-donatj-mddoc-documentation-composerrequires)
    - [Method: ComposerRequires->output](#mddoc-method-donatj-mddoc-documentation-composerrequires-output)
    - [Method: ComposerRequires->__construct](#mddoc-method-donatj-mddoc-documentation-composerrequires-construct)
    - [Method: ComposerRequires->getParent](#mddoc-method-donatj-mddoc-documentation-composerrequires-getparent)
    - [Method: ComposerRequires->getTextContent](#mddoc-method-donatj-mddoc-documentation-composerrequires-gettextcontent)
- [Class: donatj\MDDoc\Documentation\DocPage](#mddoc-class-donatj-mddoc-documentation-docpage)
    - [Method: DocPage->output](#mddoc-method-donatj-mddoc-documentation-docpage-output)
    - [Method: DocPage->setDocumentationOutputStrategy](#mddoc-method-donatj-mddoc-documentation-docpage-setdocumentationoutputstrategy)
    - [Method: DocPage->getChildren](#mddoc-method-donatj-mddoc-documentation-docpage-getchildren)
    - [Method: DocPage->getDocumentationChildren](#mddoc-method-donatj-mddoc-documentation-docpage-getdocumentationchildren)
    - [Method: DocPage->addChildren](#mddoc-method-donatj-mddoc-documentation-docpage-addchildren)
    - [Method: DocPage->__construct](#mddoc-method-donatj-mddoc-documentation-docpage-construct)
    - [Method: DocPage->getParent](#mddoc-method-donatj-mddoc-documentation-docpage-getparent)
    - [Method: DocPage->getTextContent](#mddoc-method-donatj-mddoc-documentation-docpage-gettextcontent)
- [Class: donatj\MDDoc\Documentation\DocRoot](#mddoc-class-donatj-mddoc-documentation-docroot)
    - [Method: DocRoot->output](#mddoc-method-donatj-mddoc-documentation-docroot-output)
    - [Method: DocRoot->getChildren](#mddoc-method-donatj-mddoc-documentation-docroot-getchildren)
    - [Method: DocRoot->getDocumentationChildren](#mddoc-method-donatj-mddoc-documentation-docroot-getdocumentationchildren)
    - [Method: DocRoot->addChildren](#mddoc-method-donatj-mddoc-documentation-docroot-addchildren)
    - [Method: DocRoot->__construct](#mddoc-method-donatj-mddoc-documentation-docroot-construct)
    - [Method: DocRoot->getParent](#mddoc-method-donatj-mddoc-documentation-docroot-getparent)
    - [Method: DocRoot->getTextContent](#mddoc-method-donatj-mddoc-documentation-docroot-gettextcontent)
- [Class: donatj\MDDoc\Documentation\Exceptions\ExecutionException](#mddoc-class-donatj-mddoc-documentation-exceptions-executionexception)
- [Class: donatj\MDDoc\Documentation\Exceptions\UnhandledConfigTagException](#mddoc-class-donatj-mddoc-documentation-exceptions-unhandledconfigtagexception)
- [Class: donatj\MDDoc\Documentation\ExecOutput](#mddoc-class-donatj-mddoc-documentation-execoutput)
    - [Method: ExecOutput->output](#mddoc-method-donatj-mddoc-documentation-execoutput-output)
    - [Method: ExecOutput->__construct](#mddoc-method-donatj-mddoc-documentation-execoutput-construct)
    - [Method: ExecOutput->getParent](#mddoc-method-donatj-mddoc-documentation-execoutput-getparent)
    - [Method: ExecOutput->getTextContent](#mddoc-method-donatj-mddoc-documentation-execoutput-gettextcontent)
- [Class: donatj\MDDoc\Documentation\IncludeFile](#mddoc-class-donatj-mddoc-documentation-includefile)
    - [Method: IncludeFile->output](#mddoc-method-donatj-mddoc-documentation-includefile-output)
    - [Method: IncludeFile->__construct](#mddoc-method-donatj-mddoc-documentation-includefile-construct)
    - [Method: IncludeFile->getParent](#mddoc-method-donatj-mddoc-documentation-includefile-getparent)
    - [Method: IncludeFile->getTextContent](#mddoc-method-donatj-mddoc-documentation-includefile-gettextcontent)
- [Interface: donatj\MDDoc\Documentation\Interfaces\AutoloaderAware](#mddoc-interface-donatj-mddoc-documentation-interfaces-autoloaderaware)
    - [Method: AutoloaderAware->setAutoloader](#mddoc-method-donatj-mddoc-documentation-interfaces-autoloaderaware-setautoloader)
- [Interface: donatj\MDDoc\Documentation\Interfaces\DocumentationInterface](#mddoc-interface-donatj-mddoc-documentation-interfaces-documentationinterface)
    - [Method: DocumentationInterface->output](#mddoc-method-donatj-mddoc-documentation-interfaces-documentationinterface-output)
    - [Method: DocumentationInterface->__construct](#mddoc-method-donatj-mddoc-documentation-interfaces-documentationinterface-construct)
- [Interface: donatj\MDDoc\Documentation\Interfaces\DocumentationOutputStrategyAware](#mddoc-interface-donatj-mddoc-documentation-interfaces-documentationoutputstrategyaware)
    - [Method: DocumentationOutputStrategyAware->setDocumentationOutputStrategy](#mddoc-method-donatj-mddoc-documentation-interfaces-documentationoutputstrategyaware-setdocumentationoutputstrategy)
- [Interface: donatj\MDDoc\Documentation\Interfaces\ElementInterface](#mddoc-interface-donatj-mddoc-documentation-interfaces-elementinterface)
    - [Method: ElementInterface->__construct](#mddoc-method-donatj-mddoc-documentation-interfaces-elementinterface-construct)
- [Class: donatj\MDDoc\Documentation\PhpFileDocs](#mddoc-class-donatj-mddoc-documentation-phpfiledocs)
    - [Method: PhpFileDocs->output](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-output)
    - [Method: PhpFileDocs->setAutoloader](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-setautoloader)
    - [Method: PhpFileDocs->__construct](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-construct)
    - [Method: PhpFileDocs->getParent](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-getparent)
    - [Method: PhpFileDocs->getTextContent](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-gettextcontent)
    - [Method: PhpFileDocs->setLogger](#mddoc-method-donatj-mddoc-documentation-phpfiledocs-setlogger)
- [Class: donatj\MDDoc\Documentation\RecursiveDirectory](#mddoc-class-donatj-mddoc-documentation-recursivedirectory)
    - [Method: RecursiveDirectory->setAutoloader](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-setautoloader)
    - [Method: RecursiveDirectory->output](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-output)
    - [Method: RecursiveDirectory->getChildren](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-getchildren)
    - [Method: RecursiveDirectory->getDocumentationChildren](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-getdocumentationchildren)
    - [Method: RecursiveDirectory->addChildren](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-addchildren)
    - [Method: RecursiveDirectory->__construct](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-construct)
    - [Method: RecursiveDirectory->getParent](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-getparent)
    - [Method: RecursiveDirectory->getTextContent](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-gettextcontent)
    - [Method: RecursiveDirectory->setLogger](#mddoc-method-donatj-mddoc-documentation-recursivedirectory-setlogger)
- [Class: donatj\MDDoc\Documentation\Replace](#mddoc-class-donatj-mddoc-documentation-replace)
    - [Method: Replace->output](#mddoc-method-donatj-mddoc-documentation-replace-output)
    - [Method: Replace->getChildren](#mddoc-method-donatj-mddoc-documentation-replace-getchildren)
    - [Method: Replace->getDocumentationChildren](#mddoc-method-donatj-mddoc-documentation-replace-getdocumentationchildren)
    - [Method: Replace->addChildren](#mddoc-method-donatj-mddoc-documentation-replace-addchildren)
    - [Method: Replace->__construct](#mddoc-method-donatj-mddoc-documentation-replace-construct)
    - [Method: Replace->getParent](#mddoc-method-donatj-mddoc-documentation-replace-getparent)
    - [Method: Replace->getTextContent](#mddoc-method-donatj-mddoc-documentation-replace-gettextcontent)
- [Class: donatj\MDDoc\Documentation\Section](#mddoc-class-donatj-mddoc-documentation-section)
    - [Method: Section->output](#mddoc-method-donatj-mddoc-documentation-section-output)
    - [Method: Section->getChildren](#mddoc-method-donatj-mddoc-documentation-section-getchildren)
    - [Method: Section->getDocumentationChildren](#mddoc-method-donatj-mddoc-documentation-section-getdocumentationchildren)
    - [Method: Section->addChildren](#mddoc-method-donatj-mddoc-documentation-section-addchildren)
    - [Method: Section->__construct](#mddoc-method-donatj-mddoc-documentation-section-construct)
    - [Method: Section->getParent](#mddoc-method-donatj-mddoc-documentation-section-getparent)
    - [Method: Section->getTextContent](#mddoc-method-donatj-mddoc-documentation-section-gettextcontent)
- [Class: donatj\MDDoc\Documentation\Source](#mddoc-class-donatj-mddoc-documentation-source)
    - [Method: Source->output](#mddoc-method-donatj-mddoc-documentation-source-output)
    - [Method: Source->__construct](#mddoc-method-donatj-mddoc-documentation-source-construct)
    - [Method: Source->getParent](#mddoc-method-donatj-mddoc-documentation-source-getparent)
    - [Method: Source->getTextContent](#mddoc-method-donatj-mddoc-documentation-source-gettextcontent)
- [Class: donatj\MDDoc\Documentation\Text](#mddoc-class-donatj-mddoc-documentation-text)
    - [Method: Text->output](#mddoc-method-donatj-mddoc-documentation-text-output)
    - [Method: Text->__construct](#mddoc-method-donatj-mddoc-documentation-text-construct)
    - [Method: Text->getParent](#mddoc-method-donatj-mddoc-documentation-text-getparent)
    - [Method: Text->getTextContent](#mddoc-method-donatj-mddoc-documentation-text-gettextcontent)
- [Class: donatj\MDDoc\ElementFactory](#mddoc-class-donatj-mddoc-elementfactory)
    - [Method: ElementFactory->__construct](#mddoc-method-donatj-mddoc-elementfactory-construct)
    - [Method: ElementFactory->makeFromTag](#mddoc-method-donatj-mddoc-elementfactory-makefromtag)
- [Class: donatj\MDDoc\Exceptions\ClassNotReadableException](#mddoc-class-donatj-mddoc-exceptions-classnotreadableexception)
    - [Method: ClassNotReadableException->__construct](#mddoc-method-donatj-mddoc-exceptions-classnotreadableexception-construct)
    - [Method: ClassNotReadableException->getPath](#mddoc-method-donatj-mddoc-exceptions-classnotreadableexception-getpath)
- [Class: donatj\MDDoc\Exceptions\ConfigException](#mddoc-class-donatj-mddoc-exceptions-configexception)
- [Class: donatj\MDDoc\Exceptions\DryRunMismatchException](#mddoc-class-donatj-mddoc-exceptions-dryrunmismatchexception)
    - [Method: DryRunMismatchException->__construct](#mddoc-method-donatj-mddoc-exceptions-dryrunmismatchexception-construct)
    - [Method: DryRunMismatchException->getTarget](#mddoc-method-donatj-mddoc-exceptions-dryrunmismatchexception-gettarget)
- [Class: donatj\MDDoc\Exceptions\MDDocException](#mddoc-class-donatj-mddoc-exceptions-mddocexception)
- [Class: donatj\MDDoc\Exceptions\PathNotReadableException](#mddoc-class-donatj-mddoc-exceptions-pathnotreadableexception)
    - [Method: PathNotReadableException->__construct](#mddoc-method-donatj-mddoc-exceptions-pathnotreadableexception-construct)
    - [Method: PathNotReadableException->getPath](#mddoc-method-donatj-mddoc-exceptions-pathnotreadableexception-getpath)
- [Class: donatj\MDDoc\Exceptions\TargetNotWritableException](#mddoc-class-donatj-mddoc-exceptions-targetnotwritableexception)
- [Class: donatj\MDDoc\MDDoc](#mddoc-class-donatj-mddoc-mddoc)
    - [Method: MDDoc->__construct](#mddoc-method-donatj-mddoc-mddoc-construct)
- [Class: donatj\MDDoc\Reflectors\TaxonomyReflector](#mddoc-class-donatj-mddoc-reflectors-taxonomyreflector)
    - [Method: TaxonomyReflector->__construct](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-construct)
    - [Method: TaxonomyReflector->getReflector](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getreflector)
    - [Method: TaxonomyReflector->getDocMethods](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getdocmethods)
    - [Method: TaxonomyReflector->getMethods](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getmethods)
    - [Method: TaxonomyReflector->getConstants](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getconstants)
    - [Method: TaxonomyReflector->getProperties](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getproperties)
    - [Method: TaxonomyReflector->getFunctions](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflector-getfunctions)
- [Class: donatj\MDDoc\Reflectors\TaxonomyReflectorFactory](#mddoc-class-donatj-mddoc-reflectors-taxonomyreflectorfactory)
    - [Method: TaxonomyReflectorFactory->newInstance](#mddoc-method-donatj-mddoc-reflectors-taxonomyreflectorfactory-newinstance)
- [Class: donatj\MDDoc\Runner\ConfigParser](#mddoc-class-donatj-mddoc-runner-configparser)
    - [Method: ConfigParser->__construct](#mddoc-method-donatj-mddoc-runner-configparser-construct)
    - [Method: ConfigParser->parse](#mddoc-method-donatj-mddoc-runner-configparser-parse)
- [Interface: donatj\MDDoc\Runner\DocumentationOutputStrategy](#mddoc-interface-donatj-mddoc-runner-documentationoutputstrategy)
    - [Method: DocumentationOutputStrategy->write](#mddoc-method-donatj-mddoc-runner-documentationoutputstrategy-write)
- [Class: donatj\MDDoc\Runner\DryRunDocumentationOutputStrategy](#mddoc-class-donatj-mddoc-runner-dryrundocumentationoutputstrategy)
    - [Method: DryRunDocumentationOutputStrategy->write](#mddoc-method-donatj-mddoc-runner-dryrundocumentationoutputstrategy-write)
- [Class: donatj\MDDoc\Runner\FileDocumentationOutputStrategy](#mddoc-class-donatj-mddoc-runner-filedocumentationoutputstrategy)
    - [Method: FileDocumentationOutputStrategy->__construct](#mddoc-method-donatj-mddoc-runner-filedocumentationoutputstrategy-construct)
    - [Method: FileDocumentationOutputStrategy->write](#mddoc-method-donatj-mddoc-runner-filedocumentationoutputstrategy-write)
- [Class: donatj\MDDoc\Runner\ImmutableAttributeTree](#mddoc-class-donatj-mddoc-runner-immutableattributetree)
    - [Method: ImmutableAttributeTree->withAttr](#mddoc-method-donatj-mddoc-runner-immutableattributetree-withattr)
    - [Method: ImmutableAttributeTree->shallowValue](#mddoc-method-donatj-mddoc-runner-immutableattributetree-shallowvalue)
    - [Method: ImmutableAttributeTree->deepValue](#mddoc-method-donatj-mddoc-runner-immutableattributetree-deepvalue)
- [Class: donatj\MDDoc\Runner\TextUI](#mddoc-class-donatj-mddoc-runner-textui)
    - [Method: TextUI->__construct](#mddoc-method-donatj-mddoc-runner-textui-construct)
    - [Method: TextUI->dumpOptions](#mddoc-method-donatj-mddoc-runner-textui-dumpoptions)
    - [Method: TextUI->dropError](#mddoc-method-donatj-mddoc-runner-textui-droperror)
    - [Method: TextUI->println](#mddoc-method-donatj-mddoc-runner-textui-println)
    - [Method: TextUI->log](#mddoc-method-donatj-mddoc-runner-textui-log)
    - [Method: TextUI->emergency](#mddoc-method-donatj-mddoc-runner-textui-emergency)
    - [Method: TextUI->alert](#mddoc-method-donatj-mddoc-runner-textui-alert)
    - [Method: TextUI->critical](#mddoc-method-donatj-mddoc-runner-textui-critical)
    - [Method: TextUI->error](#mddoc-method-donatj-mddoc-runner-textui-error)
    - [Method: TextUI->warning](#mddoc-method-donatj-mddoc-runner-textui-warning)
    - [Method: TextUI->notice](#mddoc-method-donatj-mddoc-runner-textui-notice)
    - [Method: TextUI->info](#mddoc-method-donatj-mddoc-runner-textui-info)
    - [Method: TextUI->debug](#mddoc-method-donatj-mddoc-runner-textui-debug)

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