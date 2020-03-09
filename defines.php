<?php

define('DEV_MODE', true);
define('DS', DIRECTORY_SEPARATOR);

// App base dir path
define('APP_BASE', __DIR__);

// Define system paths
define('SYSTEM_DIR', APP_BASE.DS.'system'.DS);
define('INCLUDES_DIR', SYSTEM_DIR.'includes'.DS);
define('CLASSES_DIR', SYSTEM_DIR.'classes'.DS);
define('SYS_ASSETS_DIR', SYSTEM_DIR.'assets'.DS);
define('SYS_TEMPLATES_DIR', SYSTEM_DIR.'templates'.DS);
define('SYS_TRANSLATIONS_DIR', SYSTEM_DIR.'translations'.DS);

// Define user paths
define('USER_DIR', APP_BASE.DS.'user'.DS);
define('PLUGINS_DIR', USER_DIR.'plugins'.DS);
define('TEMPLATES_DIR', USER_DIR.'templates'.DS);
define('UPLOADS_DIR', USER_DIR.'uploads'.DS);
define('PUBLIC_DIR', USER_DIR.'public'.DS);

// Determine request protocol
define('IS_HTTPS', !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off');
define('HTTP_PROTO', IS_HTTPS?'https':'http');

// Define some base urls
define('BASE_URL', HTTP_PROTO.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
