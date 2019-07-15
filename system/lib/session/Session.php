<?php
/**
 * Project: psf
 * User: Brendan Doyle / brendan@2cloud.ie
 * Date: 12/07/2019
 * Time: 10:45
 */

namespace App\Lib;
use App\Config;
defined('SF_VERSION') OR exit('No direct script access allowed');

/**
 * Class Session.
 * A simple helper class to make sessions a little bit more OOP. It needs to be included in the $helpers config property
 * @package App\Lib
 */
class Session
{


    /**
     * Start a new session. PSF automatically starts a new session if this is loaded.
     */
    public function start()
    {

        $config = new Config();
        $session_name = $config->session_name ? $config->session_name : '';

        if (!session_id()) {
            session_start(array('name' => $session_name));
        }

    }

    /**
     * Get session data by session name
     * @param $session - the session name
     * @return mixed
     */
    public function get($session)
    {


        return $_SESSION[$session];

    }

    /**
     * Destroy a session
     */
    public function end()
    {

        session_start();
        session_destroy();

    }

    /**
     * Sets a flash message in session, useful for showing  errors or success messages
     * Needs to be called using helper show_slash_msg()
     * @see show_flash_msg()
     * @param $class
     * @param $msg
     */
    public function flash_message($class, $msg)
    {

        $this->set('flash_msg', array('class' => $class, 'msg' => $msg));

    }

    /**
     * Set session data.
     * @param $name - The session name / key
     * @param $data - The session data
     */
    public function set($name, $data)
    {


        $_SESSION[$name] = $data;

    }


}