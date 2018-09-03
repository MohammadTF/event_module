<?php
namespace Tob_Events\Classes;


class Tob_Events_Template {
	
	protected $file;
	protected $values = array();

	public function __construct($file,$type) {
		$this->file = TOB_E_PLUGIN_PATH.$type.'/partials/'.$file;	
	}

	/**
	 * Set Value for template
	 *
	 * @param [string] $key
	 * @param [string] $value
	 * @return void
	 */
	public function setValue($key, $value) {
		$this->values[$key] = $value;
	}

	/**
	 * Set Values for template
	 *
	 * @param [array] $values
	 * @return void
	 */
	public function setValues($values) {
		foreach ($values as $key => $value) {
			$this->values[$key] = $value;
		}
	}

	/**
	 * Output template
	 *
	 * @return string
	 */
	public function output() {
		if (!file_exists($this->file)) {
			return "Error loading template file ($this->file).<br />";
		}
		$output = file_get_contents($this->file);

		foreach ($this->values as $key => $value) {
			$tagToReplace = "[@$key]";
			$output = str_replace($tagToReplace, $value, $output);
		}

		$pattern = '/[[@a-z_]+]/';
		$output = preg_replace($pattern,'',$output);

		return $output;
	}
}