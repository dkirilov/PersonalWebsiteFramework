<?php

namespace PWF\System\Parsers;

/**
 * This class is used to parse Personal Website Framework's config files(so called "pwfc" files)
 */
class PwfcParser
{
	public $parsed = array();

	public function parseString(string $pwfc){
		// Parse uncommented rows
		$re = '/(?\'setting\'^[A-z_]+)[ ]+\=[ ]+(?\'value\'\"{1}(?\'stringval\'.+)\"{1}|[0-9.]+|true|false)\;$/m';
		@preg_match_all($re, $pwfc, $matches);

		if(!empty($matches['setting'])){
			for($i=0; $i<count($matches['setting']); $i++){
				$setting_name = $matches['setting'][$i];
				$value = $matches['value'][$i];

				if(self::isStringValue($value)){
					$value = $matches['stringval'][$i];
				}

				$this->parsed[$setting_name] = $value;
			}
		}
	}

	public function parseFile(string $file_path){
		$pwfc_string = $this->loadFile($file_path);
		$this->parseString($pwfc_string);
	}

	private function loadFile(string $file_path){
		return file_get_contents($file_path);
	}

	private function isStringValue(string $value){
		return !empty(preg_match('/\".+\"/m', $value));
	}
}