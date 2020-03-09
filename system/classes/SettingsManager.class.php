<?php

namespace PWF\System;

use PWF\System\Parsers\PwfcParser;

class SettingsManager{
	private $parser = null;

	public function __construct(){
		$this->parser = new PwfcParser();
	}

	public function loadSettingsFile(string $file_path){
		$this->parser->parseFile($file_path);
	}

	public function loadSystemConfig(){
		$this->loadSettingsFile(SYSTEM_DIR . 'config.pwfc');
	}

	public function loadTemplateSettings(string $template_name){
		$this->loadSettingsFile(TEMPLATES_DIR . $template_name . DS . 'settings.pwfc');
	}

	public function loadPluginSettings(string $plugin_name){
		$this->loadSettingsFile(PLUGINS_DIR . $plugin_name . 'settings.pwfc');
	}

	public function getSetting(string $setting_name){
		 if(isset($this->parser->parsed[$setting_name])){
		 	return $this->parser->parsed[$setting_name];
		 }

		 return false;
	}

	public function getSettingsArray(){
		return $this->parser->parsed;
	}

}