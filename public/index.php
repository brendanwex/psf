<?php
/**
 * Copyright (c) 2017.
 * Do not modify this file, see Config.php for modifications and constants
 * @Version 1.0
 */
define("SF_VERSION", '1.0.0');

include("../Config.php");



$config = new \App\Config();




require('../'.$config->system_dir. "/bootstrap.php");


$controller = new \App\Controller();


$controller->router->route();




