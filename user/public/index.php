<?php

require_once("../../app.php");

$path = isset($_REQUEST['path'])?$_REQUEST['path']:'/';

\PWF\App::init($path);
