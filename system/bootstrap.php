<?php
defined('SF_VERSION') OR exit('No direct script access allowed!');


/*
 * Enable errors if DEV_MODE is true
 */
if ($config->dev_mode) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}


/**
 * Defined paths and dirs
 */

define('VIEWS_PATH', $config->abs_path . DIRECTORY_SEPARATOR . $config->app_dir . DIRECTORY_SEPARATOR . "views/");
define('MODULES_PATH', $config->abs_path . DIRECTORY_SEPARATOR . $config->app_dir . DIRECTORY_SEPARATOR . "/modules/");
define('APP_PATH', $config->abs_path . DIRECTORY_SEPARATOR . $config->app_dir . DIRECTORY_SEPARATOR);
define('SYSTEM_PATH', $config->abs_path . DIRECTORY_SEPARATOR . $config->system_dir . DIRECTORY_SEPARATOR);
define('DEV_LOG_DIR', $config->abs_path . DIRECTORY_SEPARATOR . $config->app_dir . DIRECTORY_SEPARATOR . "logs/");
define("BASE_PATH", $config->base_url);

/*
 * Error View
 */
define('ERROR_VIEW', VIEWS_PATH . "errors/404.php");
define('EXCEPTION_VIEW', VIEWS_PATH . "errors/exception.php");


/*
 * Time Zone & date Format
 */
ini_set("date.timezone", $config->timezone);
define('DATE_FORMAT', $config->date_format);


/*
 * Routing
 */

define('DEFAULT_CONTROLLER', $config->default_controller);

define('DEFAULT_METHOD', $config->default_method);


/*
 * Composer
 */
if ($config->composer) {

    if (file_exists($config->abs_path . $config->composer_path)) {
        include($config->abs_path . $config->composer_path);
    }

}


/**
 * Load helpers specified in Config.php
 */
foreach ($config->helpers as $helper) {

    if (file_exists(APP_PATH . "/helpers/" . $helper . ".php")) {
        include_once(APP_PATH . "/helpers/" . $helper . ".php");
    }
}


/**
 * Load custom libs specified in Config.php
 */
foreach ($config->libraries as $lib) {

    if (file_exists(APP_PATH . "/libraries/" . $lib . ".php")) {
        include_once(APP_PATH . "/libraries/" . $lib . ".php");
    }
}


/**
 * Load libs specified in Config.php
 */

if (in_array('session', $config->autoload)) {

    include_once(SYSTEM_PATH . "/lib/session/Session.php");

}

if (in_array('uploader', $config->autoload)) {
    include_once(SYSTEM_PATH . "/lib/uploader/Uploader.php");
    include_once(SYSTEM_PATH . "/lib/uploader/Thumbs.php");


}
if (in_array('datatable', $config->autoload)) {

    include_once(SYSTEM_PATH . "/lib/datatable/DataTable.php");

}
if (in_array('hooks', $config->autoload)) {

    include_once(SYSTEM_PATH . "/lib/hooks/php-hooks.php");

}


/**
 * Load our helpers
 */

include(SYSTEM_PATH . "helpers.php");


/*
 * Load our logging class
 */
include(SYSTEM_PATH . "lib/logger/Logger.php");


/*
 * Load our router class
 */
include(SYSTEM_PATH . "lib/router/Router.php");

/*
 * Load our DB library
 */
include(SYSTEM_PATH . "lib/database/MysqliDb.php");


/*
 * Load Our Parent Model Class
 */
include(SYSTEM_PATH . "Model.php");

/*
 * Load our parent Controller
 */
include(SYSTEM_PATH . "Controller.php");


/*
 * Load custom models
 */
foreach (glob(APP_PATH . "models/*.php") as $filename) {
    include $filename;
}

/*
 * Load custom controllers
 */
foreach (glob(APP_PATH . "controllers/*.php") as $filename) {
    include $filename;
}

