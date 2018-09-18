<?php

namespace donatj\MDDoc\Documentation;

use donatj\MDDoc\Documentation\Exceptions\ExecutionException;
use donatj\MDDoc\Exceptions\ConfigException;
use donatj\MDDom\Code;
use donatj\MDDom\CodeBlock;
use donatj\MDDom\Paragraph;

class ExecOutput extends AbstractDocPart {

	const FORMAT_DEFAULT    = 'default';
	const FORMAT_RAW        = 'raw';
	const FORMAT_CODE       = 'code';
	const FORMAT_CODE_BLOCK = 'code-block';

	private $formats = [
		self::FORMAT_DEFAULT,
		self::FORMAT_RAW,
		self::FORMAT_CODE,
		self::FORMAT_CODE_BLOCK,
	];


	/**
	 * @param int $depth
	 * @return \donatj\MDDom\Code|\donatj\MDDom\CodeBlock|\donatj\MDDom\Paragraph|string
	 * @throws \donatj\MDDoc\Documentation\Exceptions\ExecutionException
	 * @throws \donatj\MDDoc\Exceptions\ConfigException
	 */
	public function output( $depth ) {
		$cmd    = $this->getOption('cmd');
		$format = $this->getOption('format');

		if( !in_array($format, $this->formats) ) {
			throw new ConfigException("Invalid exec format '{$format}', expected to be in: " . implode(', ', $this->formats));
		}

		exec($cmd, $output, $return);

		if( $return !== 0 ) {
			throw new ExecutionException("Command `{$cmd}` returned exit code: {$return}", $return);
		}

		if( $format == self::FORMAT_DEFAULT ) {
			$md = implode($output, "  \n");
		} else {
			$md = implode($output, "\n");
		}


		switch( $format ) {
			case self::FORMAT_DEFAULT:
			case self::FORMAT_RAW:
				return new Paragraph($md);
			case self::FORMAT_CODE:
				return new Code($md);
			case self::FORMAT_CODE_BLOCK:
				return new CodeBlock($md, $this->getOption('language'));
			default:
				throw new \RuntimeException("unhandled format '$format'");
		}
	}

	protected function init() {
		$this->requireOptions('cmd');
		$this->setOptionDefault('format', self::FORMAT_DEFAULT);
	}

}
