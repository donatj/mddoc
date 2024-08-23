<?php

/**
 * Reads the current projects' composer.json file and outputs the install command
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Exceptions\PathNotReadableException;
use donatj\MDDom\CodeBlock;
use donatj\MDDom\Paragraph;

class ComposerInstall extends AbstractDocPart {

	/** Text to display before the install command */
	public const OPT_TEXT = 'text';

	/** Whether to include global subcommand */
	public const OPT_GLOBAL = 'global';

	/** Whether to include --dev flag */
	public const OPT_DEV = 'dev';

	/** Package name override. Comma delimited. Defaults to `name` key of composer.json */
	public const OPT_PACKAGE_NAMES = 'package-names';

	public function output( int $depth ) : Paragraph {

		$packageNames = [];

		if( $packageNamesString = $this->getOption(self::OPT_PACKAGE_NAMES) ) {
			$packageNames = explode(',', $packageNamesString);
			$packageNames = array_map('trim', $packageNames);
			$packageNames = array_filter($packageNames);
		}

		$composerName = null;

		try {
			$file   = $this->getWorkingFilePath('composer.json');
			$data   = @file_get_contents($file);
			if( $data === false ) {
				throw new PathNotReadableException('Unable to read composer.json', $file);
			}

			$parsed = @json_decode($data, true);
			if( is_array($parsed) && !empty($parsed['name']) ) {
				$composerName = $parsed['name'];
			}
		}catch(PathNotReadableException $e) {
			// ignore
		}

		if($packageNames) {
			foreach($packageNames as $key => $packageName) {
				if( $packageName === '.' ) {
					if(!$composerName) {
						throw new \RuntimeException('Unable to determine composer package name from composer.json');
					}

					$packageNames[$key] = $composerName;
				}
			}
		}elseif( $composerName ) {
			$packageNames = [ $composerName ];
		}

		if(!$packageNames) {
			throw new \RuntimeException('Unable to determine composer package name from composer.json and no package names provided');
		}

		$para = new Paragraph;
		$text = $this->getOption(self::OPT_TEXT) ?? 'Install the latest version with:';
		if( $text ) {
			$para->appendChild($text);
		}

		$install = 'composer';
		if( $this->getOption(self::OPT_GLOBAL) == 'true' ) {
			$install .= ' global';
		}

		$install .= ' require';
		if( $this->getOption(self::OPT_DEV) == 'true' ) {
			$install .= ' --dev';
		}

		foreach( $packageNames as $name ) {
			$install .= ' ' . escapeshellarg($name);
		}

		$para->appendChild(new CodeBlock($install, 'bash'));

		return $para;
	}

	protected function init() : void { }

	public static function tagName() : string {
		return 'composer-install';
	}

}
