<?php
/**
 * Copyright (c) 2017.
 * Do not modify this file, see Config.php for modifications and constants
 * @Version 1.0
 */
define("SF_VERSION", '1.0.0');

$debug = explode(' ', microtime())[0] + explode(' ', microtime())[1];

include("../Config.php");



$config = new \App\Config();




require('../'.$config->system_dir. "/bootstrap.php");


$controller = new \App\Controller();


$controller->router->route();

if($config->dev_mode) {
    echo('<!--Page generated in ' . round((explode(' ', microtime())[0] + explode(' ', microtime())[1]) - $debug, 4) . ' seconds. PSF Dev Mode Enabled -->');
}


