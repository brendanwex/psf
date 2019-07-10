<?php

namespace App;

class Config
{


    /**
     * Base URL WITH trailing slash
     */

    public $base_url = "https://office.local/psf/public/";

    /**
     * System base path
     */
    public $abs_path = __DIR__;

    /**
     * Force SSL
     */
    public $https = "on";

    /**
     * The directory name where your code is located
     */
    public $app_dir = "app";

    /**
     * The system folder, default system
     */
    public $system_dir = "system";

    /**
     * The front facing public folder, sometimes httpdocs (plesk) or public_html (cpanel)
     */
    public $public_dir = "public";


    /**
     * Enable development mode, will show exceptions, otherwise a 404. Should be false on production sites
     */

    public $dev_mode = true;

    /**
     * Logging, true or false
     *
     */

    public $logging = true;

    /**
     * Database
     */

    public $database = ['on' => false, 'name' => 'whyq', 'user' => 'root', 'password' => '', 'prefix' => 'app_', 'port' => 3306, 'host' => 'localhost'];


    /**
     * Composer
     */


    public $composer = true;

    public $composer_path = "vendor/autoload.php";


    /**
     * Dates and Time
     */

    public $timezone = "Europe/Dublin";

    public $date_format = "d-m-Y";


    /**
     * Encryption
     */



    /**
     * Autoload Built In Libraries
     *
     * There aren't many!
     *
     */

    public $autoload = ['uploader', 'hooks', 'datatable'];



    /**
     * These are your own helpers located in the app/helpers directory.
     *
     * They should be loaded by filename without the .php extension
     *
     * eg functions.php would be loaded with public $helpers = ['functions'];
     */
    public $helpers = ['functions', 'hooks'];


}

