<?php

namespace PWF\System\Assets;

class Asset{
	private $name = null;
	private $ext = null;
	private $type = null;
	private $path = null;
	private $url = null;
	private $priority = null;

	private static $allowed_types = array('JavaScript', 'StyleSheet', 'Image', 'Video');
	private static $allowed_extensions = array('js', 'css', 'jpg', 'jpeg', 'png', 'gif', 'mp4', 'webm');

	public function __construct(string $name, string $type, string $ext, string $path, string $url, int $priority = 0){
		$this->setName($name);
		$this->setType($type);
		$this->setExtension($ext);
		$this->setPath($path);
		$this->setUrl($url);
		$this->setPriority($priority);
	}

	public function setName(string $name){
		 $this->name = $name;
	}

	public function setType(string $type){
		if(!self::isAllowedType($type)){
			throw new \Exception("Invalid asset type <em>$type</em>!", 145);
		}

		$this->type = $type;
	}

	public function setExtension(string $ext){
		if(!self::isAllowedExtension($ext)){
			throw new \Exception("Invalid asset file extension <em>$ext</em>!", 146);
		}

		$this->ext = $ext;
	}

	public function setPath(string $file_path){
		if(!file_exists($file_path)){
			throw new \Exception("Invalid file path! File doesn't exist at this location.", 147);
		}

		if(is_dir($file_path)){
			throw new \Exception("Invalid file path! Asset path's end point cannot be a directory.");
		}

		$this->path = $file_path;
	}

	public function setUrl(string $url){
		// TODO: Check whether the passed value is a valid URL
		$this->url = $url;
	}

	public function setPriority(int $priority){
		$this->priority = $priority;
	}

	public function getProperty(string $property_name){
		if(isset($this->$property_name)){
			return $this->$property_name;
		}

		throw new \Exception("Property <ins>$property_name</ins> doesn't exist!", 149);
	}

	public static function getAllowedExtensions(){
		return self::$allowed_extensions;	
	}

	public static function isAllowedExtension(string $ext){
		return in_array($ext, self::$allowed_extensions);
	}

	public static function getAllowedTypes(){
		return self::$allowed_types;
	}

	public static function isAllowedType(string $asset_type){
		return in_array($type, self::$allowed_types);
	}

}
