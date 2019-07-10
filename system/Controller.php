<?php

/**
 * @User Brendan
 * @File Controller.php
 * @Date 29-Mar-17  2:15 PM
 * @Version 1.0
 * @Since 1.0
 *
 * Our main controller file
 */

namespace App;

use App\Lib\DataTable;
use App\Lib\Logger;
use App\Lib\Uploader;


defined('SF_VERSION') OR exit('No direct script access allowed');


class Controller
{

    public function __construct()
    {


        $this->config = new Config();

        //Make our router class available
        $this->router = new Lib\Router();


        //Database

        if ($this->config->database['on']) {
            $this->db = new \Db(array('host' => $this->config->database['host'], 'username' => $this->config->database['user'], 'password' => $this->config->database['password'], 'db' => $this->config->database['name'], 'port' => $this->config->database['port'], 'prefix' => $this->config->database['prefix']));

        }


        //Logger, if enabled in Config.php

        if ($this->config->dev_mode):
            $this->logger = new Logger();
        endif;


        if (class_exists('App\Lib\Uploader')) {
            //Uploader
            $this->uploader = new Uploader();


        }

        if (class_exists('App\Lib\DataTable')) {
            //Data Table

            $this->data_table = new DataTable();

        }

        if (class_exists('Hooks')) {
            //Hooks
            global $hooks;

            $hooks->add_action('init', array($this, 'load_modules'), 0);
        }


    }


    /**
     * @param        $view
     * @param string $data
     *
     * Calls the view from within a controller
     */
    public function view($view, $data = array(), $string = null, $path = VIEWS_PATH, $template = "")
    {


        try {


            if (file_exists($path . $view . ".php")) {

                if (!empty($data)) {
                    extract($data);
                }


                if ($string) {
                    ob_start();
                }

                if (!empty($template)) {
                    include($path . $view . ".php");

                } else {
                    include($path . $template . "/" . $view . ".php");

                }

                if ($string) {
                    $output = ob_get_contents();
                    ob_end_clean();

                    return $output;
                }


            } else {

                throw new \Exception('File does not exist');

            }

        } catch (\Exception $e) {


            if ($this->config->logging) {
                $log = new Logger();
                $log->log($e->getMessage() . ' in ' . $e->getFile() . ' line ' . $e->getLine());
            }


            if ($this->config->dev_mode) {


                include(EXCEPTION_VIEW);


            } else {

                error_404();
            }


        }


    }


    /**
     * @param $location
     *
     * OOP Wrapper for redirect
     */
    public function redirect($location, $flash_msg = array())
    {

        session_start();

        if (!empty($flash_msg)) {


            $_SESSION['flash_msg'] = $flash_msg;

        }
        header("location: " . BASE_PATH . $location);
        exit;

    }


}