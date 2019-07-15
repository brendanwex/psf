<?php
namespace App;

use App\Lib\Logger;
use App\Lib\Uploader;
use App\Lib\MysqliDb;

defined('SF_VERSION') OR exit('No direct script access allowed');

/**
 * The main Model class.
 * You can extend this class in your custom models to allow you quick access to inbuilt libraries such as $this->db, $this->uploader, $this->logger if enabled in Config.php
 * @package PSF
 * @since 1.0.0
 *
 *
 *
 */
class Model
{


    /**
     * Model constructor.
     */
    function __construct()
    {

        $this->config = new Config();


        //Database

        if ($this->config->database['on']) {
            $this->db = new MysqliDb(array('host' => $this->config->database['host'], 'username' => $this->config->database['user'], 'password' => $this->config->database['password'], 'db' => $this->config->database['name'], 'port' => $this->config->database['port'], 'prefix' => $this->config->database['prefix']));

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