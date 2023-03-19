<?php

/**
 * Execute a command and include the standard output in the documentation
 */

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Exceptions\ExecutionException;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDom\AbstractElement;
use donatj\MDDom\Code;
use donatj\MDDom\CodeBlock;
use donatj\MDDom\Paragraph;

class ExecOutput extends AbstractDocPart {

	/**
	 * The command to execute
	 * @mddoc-required
	 */
	public const OPT_CMD = 'cmd';
	/** The format to output the result in - options include "raw" "code" and "code-block" defaults to "raw" */
	public const OPT_FORMAT = 'format';

	public const FORMAT_DEFAULT    = 'default';
	public const FORMAT_RAW        = 'raw';
	public const FORMAT_CODE       = 'code';
	public const FORMAT_CODE_BLOCK = 'code-block';

	private const FORMATS = [
		self::FORMAT_DEFAULT,
		self::FORMAT_RAW,
		self::FORMAT_CODE,
		self::FORMAT_CODE_BLOCK,
	];

	/**
	 * @throws \donatj\MDDoc\Exceptions\ConfigException
	 * @throws \donatj\MDDoc\Documentation\Exceptions\ExecutionException
	 */
	public function output( int $depth ) : AbstractElement {
		$cmd    = $this->getOption(self::OPT_CMD);
		$format = $this->getOption(self::OPT_FORMAT);

		if( !in_array($format, self::FORMATS, true) ) {
			throw new ConfigException("Invalid exec format '{$format}', expected to be in: " . implode(', ', self::FORMATS));
		}

		exec($cmd, $output, $return);

		if( $return !== 0 ) {
			throw new ExecutionException("Command `{$cmd}` returned exit code: {$return}", $return);
		}

		if( $format === self::FORMAT_DEFAULT ) {
			$md = implode("  \n", $output);
		} else {
			$md = implode("\n", $output);
		}

		switch( $format ) {
			case self::FORMAT_DEFAULT:
			case self::FORMAT_RAW:
				return new Paragraph($md);
			case self::FORMAT_CODE:
				return new Code($md);
			case self::FORMAT_CODE_BLOCK:
				return new CodeBlock($md, $this->getOption('lang'));
			default:
				throw new \RuntimeException("unhandled format '$format'");
		}
	}

	protected function init() : void {
		$this->requireOption(self::OPT_CMD);
		$this->setOptionDefault(self::OPT_FORMAT, self::FORMAT_DEFAULT);
	}

	public static function tagName() : string {
		return 'exec';
	}

}
