<?php

namespace PWF;

require_once("defines.php");
require_once(INCLUDES_DIR . 'functions.php');

use PWF\System\Autoloader;

class App{
    private static $instance = null;

    private function __construct(string $path){
            self::setDisplayErrors();
            
            self::loadIncludes();

            Autoloader::register();

            // Set exception handler

            // Load system settings

            // Set path

            // Set current user

            // Set language

            // Load and set cookie and session

            // Set translator

            // Set template
    }

    public static function init(string $path){
        if(!self::$instance){
            self::$instance = new App($path);
        }
    }

    public static function getInstance(){
        return self::$instance;
    }

    private static function loadIncludes(){
        $flist = scandir(INCLUDES_DIR);
        foreach($flist as $fn){
            $fext = pathinfo($fn, PATHINFO_EXTENSION);
            if(strtolower($fext) == 'php'){
                require_once(INCLUDES_DIR.$fn);
            }
        }
    }

    private static function setDisplayErrors(){
        ini_set('display_errors',  DEV_MODE);
        ini_set('display_startup_errors', DEV_MODE);
        error_reporting(DEV_MODE?E_ALL:E_USER);
    }
    
}
