<?php

namespace PWF\System\template;

use PWF\System\SettingsManager;
use PWF\System\Assets\AssetsManager;

class Template{
	public $name = null;
	public $translator = null;

	private $settingsManager = null;
	private $assetsManager = null;

	public $paths = array(
		'template_dir' => null,
		'css_dir' => null,
		'js_dir' => null,
		'img_dir' => null
	);

	public $urls = array(
		'css_dir' => null,
		'js_dir' => null,
		'img_dir' => null
	);

    // @param string $type Determines what type of template the user wants to load. Posiible values: "system", "regular", "plugin".
    // @param string $name Determines the name of template that should be loaded. If you've passed "plugin" as a type, then you need to put plugin's name here.
    public function __construct(string $type = "regular", string $name = null){
        if($type !== "system" && empty($name)){
            throw new \Exception('Template name is missing! Please provide \'$name\' parameter with a valid template name.', 100);
        }

        $this->setPaths($type);
        $this->setUrls($type);  
    }

    private function setName(string $name){
          $this->name = $name;
    }

    private function setTranslator(){
          $this->translator = new Translator();
    }

    private function setPaths(string $type){
          switch($type){
                case 'regular':
                    $this->paths['template_dir'] = TEMPLATES_DIR . $this->name . DS;
                    $this->paths['css_dir'] = $this->paths['template_dir'] . 'assets' . DS . 'css' . DS;
                    $this->paths['js_dir'] = $this->paths['template_dir'] . 'assets' . DS . 'js' . DS;
                    $this->paths['img_dir'] = $this->paths['template_dir'] . 'assets' . DS . 'img' . DS;
                    break;
                case 'plugin':
                    $this->paths['template_dir'] = PLUGINS_DIR . $this->name . DS . 'templates' . DS;
                    $this->paths['css_dir'] =  PLUGINS_DIR . $this->name . DS . 'assets' . DS . 'css' . DS;
                    $this->paths['js_dir'] =  PLUGINS_DIR . $this->name . DS . 'assets' . DS . 'js' . DS;
                    $this->paths['img_dir'] =  PLUGINS_DIR . $this->name . DS . 'assets' . DS . 'img' . DS;
                    break;
                case 'system':
                    $this->paths['template_dir'] = SYS_TEMPLATES_DIR;
                    $this->paths['css_dir'] = SYS_ASSETS_DIR . 'css' . DS;
                    $this->paths['js_dir'] = SYS_ASSETS_DIR . 'js' . DS;
                    $this->paths['img_dir'] = SYS_ASSETS_DIR . 'img' . DS;
                    break;
                default:
                    throw new \Exception("Unsupported template type!", 101);
                    break;
          }
    }

    private function setUrls(string $type){
         $this->urls['css_dir'] = BASE_URL . "assets/$type/css/";
         $this->urls['js_dir'] = BASE_URL . "assets/$type/js/";
         $this->urls['img_dir'] = BASE_URL . "assets/$type/img/";
    }

    private function loadSettings(){
        $this->settingsManager = new SettingsManager();
        $this->settingsManager->loadTemplateSettings($this->name);
    }

    private function loadAssets(){
        $this->assetsManager = new AssetsManager();
    }
    
    public function getSetting(string $setting_name){
        return $this->settingsManager->getSetting($setting_name);
    }

    public function getAsset(string $asset_name, string $asset_type){
    
    }
 
    public function includeTemplatePart(string $part_name){

    }
 
    public function render(){

    }
}
