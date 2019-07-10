<?php
/**
 * @User Brendan
 * @Package custom-php-framework
 * @File Router.php
 * @Date 04-Apr-17  9:36 AM
 * @Version
 */


namespace App\Lib;

defined('SF_VERSION') OR exit('No direct script access allowed!');


class Router
{


    private function _parse_route()
    {


        $request = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

        $routes = str_replace(BASE_PATH, '', $request);

        $url_parts = parse_url($routes);


        if (empty($url_parts['path'])) {
            //root controller
            $sections = array();
        } else {


            $sections = explode("/", $url_parts['path']);

        }


        return $sections;


    }


    function uri_segment($n)
    {

        $sections = $this->_parse_route();

        if (!empty($sections[$n])) {
            return $sections[$n];
        } else {

            return false;

        }

    }


    /**
     * Converts methods with dashes in url to underscores for function
     */
    function dash_to_underscore($string)
    {

        if (strpos($string, "-") !== false) {
            $new_string = str_replace("-", "_", $string);

        } else {

            $new_string = $string;
        }

        return $new_string;

    }


    public function route()
    {


        global $config;

        $sections = $this->_parse_route();


        if (empty($sections[0])) {
            $sections[0] = DEFAULT_CONTROLLER;
        }
        if (empty($sections[1])) {
            $sections[1] = DEFAULT_METHOD;
        }


        try {


            // Force uppercase on class names for unix


            if (!class_exists(ucfirst($sections[0])) || !method_exists(ucfirst($sections[0]), $this->dash_to_underscore($sections[1]))) {


                throw new \Exception('Controller or method specified may not exist, or method may not be publicly accessible.');

                //print_r($sections);


            } else {

                $main_controller = ucfirst($sections[0]);

                $router = new $main_controller();


                //We convert dashes to underscore for methods to load.


                $router->{$this->dash_to_underscore($sections[1])}();
            }

        } catch (\Exception $e) {

            if ($config->logging) {
                $log = new Logger();
                $log->log($e->getMessage() . ' in ' . $e->getFile() . ' line ' . $e->getLine());
            }


            if ($config->dev_mode) {

              include(EXCEPTION_VIEW);

            } else {

                error_404();

            }


        }


    }

}
