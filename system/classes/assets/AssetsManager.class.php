<?php 

namespace PWF\System\Assets;

class AssetsManager{
	private $assets = array();

	public function __construct(){

	}

	public function loadSystemAsset(string $name, string $type, int $priority = 0){
		$ext = pathinfo($name, PATHINFO_EXTENSION);
		$filename = pathinfo($name, PATHINFO_FILENAME);

		$path = SYS_ASSETS_DIR . self::typeToShort($type) . DS . $name;
		$url = BASE_URL . '/asset/system/' . self::typeToShort($type) . '/' . $name;

		$this->assets[$name] = new Asset($filename, $type, $ext, $path, $url, $priority);
	}

	public function loadTemplateAsset(string $template_name, string $asset_name, string $asset_type, int $priority = 0){
		$asset_fname = pathinfo($asset_name, PATHINFO_FILENAME);
		$asset_ext = pathinfo($asset_name, PATHINFO_EXTENSION);
		$asset_path = TEMPLATES_DIR . $template_name . DS . 'assets' . DS . self::typeToShort($asset_type) . DS . $asset_name;
		$asset_url = BASE_URL . '/asset/template/' . $template_name . '/' . self::typeToShort($asset_type) . '/' . $asset_name;

		$this->assets[$asset_name] = new Asset($asset_fname, $asset_type, $asset_ext, $asset_path, $asset_url, $priority);
	}

	public function loadPluginAsset(string $plugin_name, string $asset_name, string $asset_type, int $priority = 0){
		$asset_fname = pathinfo($asset_name, PATHINFO_FILENAME);
		$asset_ext = pathinfo($asset_name, PATHINFO_EXTENSION);
		$asset_path = PLUGINS_DIR . $plugin_name . DS . 'assets' . DS . self::typeToShort($asset_type) . DS . $asset_name;
		$asset_url = BASE_URL . '/asset/plugin/' . $plugin_name . '/' . self::typeToShort($asset_type) . '/' . $asset_name;

		$this->assets[$asset_name] = new Asset($asset_fname, $asset_type, $asset_ext, $asset_path, $asset_url, $priority);
	}

	public function getAsset(string $asset_name){
		if(isset($this->assets[$asset_name])){
			return $this->assets[$asset_name];
		}else{
			return false;
		}
	}

	public function getAssets(){
		return $this->assets;
	}

	public function getAssetsByType(string $asset_type){
		$result = array();
		
		foreach ($this->assets as $name => $asset) {
			if($asset->getProperty('type') == $asset_type){
				$result[$name] = $asset; 
			}
		}

		return $result;
	}

	private static function typeToShort(string $asset_type){
		switch ($asset_type) {
			case 'StyleSheet':
				return 'css';
			case 'JavaScript':
				return 'js';
			case 'Image':
				return 'img';
			case 'Video':
				return 'vid';
			default:
				return $asset_type;
		}
	}
}