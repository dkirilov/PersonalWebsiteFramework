<?php

namespace PWF\System;

class Autoloader{
    private function __construct(){}

    public static function load(string $class){
        $class = self::fixPath($class);

        if(self::isSystemClass($class)){
            self::loadSystemClass($class);
        }else if(self::isPluginClass($class)){
            self::loadPluginClass($class);
        }
    }

    public static function isSystemClass(string $class){
        $parts = explode(DS, $class);
        return $parts[1] === 'System';
    }

    public static function isPluginClass(string $class){
        $parts = explode(DS, $class);
        return $parts[1] === 'Plugins';
    }

    public static function loadSystemClass(string $class){
        $namespace = self::fixPath(__NAMESPACE__.DS);
        $class = str_replace($namespace, "", $class);
        $fp = CLASSES_DIR.$class.'.class.php';

        if(!file_exists($fp)){
            $fp = CLASSES_DIR.self::pathToLower($class).'.class.php';
        }

        require_once($fp);
    }

    public static function loadPluginClass(string $class){
        $namespace = self::fixPath(__NAMESPACE__.DS);
        $class = str_replace($namespace, "", $class);
        $fp = PLUGINS_DIR.'classes'.DS.$class.'.class.php';

        if(!file_exists($fp)){
            $fp = PLUGINS_DIR.'classes'.DS.self::pathToLower($class).'.class.php';
        }

        require_once($fp);
    }

    public static function register(){
        spl_autoload_register(__NAMESPACE__."\\Autoloader::load");
    }

    private static function fixPath(string $path){
        if(DS !== "\\"){
            return str_replace("\\", DS, $path);
        }else{
            return $path;
        }
    }

    private static function pathToLower(string $path){
        $path = explode(DS, $path);
        for($i=0; $i<count($path)-1; $i++){
            $path[$i] = strtolower($path[$i]);
        }
        return implode(DS, $path);
    }
}
