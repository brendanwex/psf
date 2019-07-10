<?php
/**
 * Project: psf
 * User: Brendan Doyle / brendan@2cloud.ie
 * Date: 10/07/2019
 * Time: 16:37
 */

class Home extends \App\Controller
{


    public function index(){




        $data = array(

            'title' => 'Welcome to PSF Demo',
            'version' => SF_VERSION,
            'content' => 'Welcome to PHP Simple Framework Demo. This the default view, located in views/home.php and called from controllers/Home.php</i>',
            'features' => array(

                'Simple MVC Framework',
                'Your code is kept behind the public folder',
                'Autoload all Controllers and Models',
                'Has Composer Support',
                '5 Simple Helper Classes - DB (<a href="https://github.com/ThingEngineer/PHP-MySQLi-Database-Class" target="_blank">MysqliDb</a>), Uploader, Router, Hooks & Logger',
                'All helpers can be disabled so you can use your own from composer, or free style',
                'Thats it.',

            )

        );


        $this->view('home', $data);


    }
}