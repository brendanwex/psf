<?php
/**
 * @User Brendan
 * @Package custom-php-framework
 * @File controller.class.php
 * @Date 29-Mar-17  2:15 PM
 * @Version
 */

namespace App;

use App\Lib\Logger;
use App\Lib\Uploader;

defined('SF_VERSION') OR exit('No direct script access allowed');

class Model
{


    function __construct()
    {

        $this->config = new Config();


        //Database

        if ($this->config->database['on']) {
            $this->db = new \Db(array('host' => $this->config->database['host'], 'username' => $this->config->database['user'], 'password' => $this->config->database['password'], 'db' => $this->config->database['name'], 'port' => $this->config->database['port'], 'prefix' => $this->config->database['prefix']));

        }

        if(class_exists('Uploader')){
            //Uploader
            $this->uploader = new Uploader();
        }

        //Logger, if enabled in Config.php
        if ($this->config->dev_mode):
            $this->logger = new Logger();
        endif;


    }


}