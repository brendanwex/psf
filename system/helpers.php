<?php
/**
 * Project: psf
 * User: Brendan Doyle / brendan@2cloud.ie
 * Date: 10/07/2019
 * Time: 16:40
 */

/**
 * Generates a 404 page.
 * Layout can be changed in views/errors/404.php
 */
function error_404(){

    header("HTTP/1.0 404 Not Found");
    include(ERROR_VIEW);
    die();
}

/**
 * Shows a flash message if set
 */
function show_flash_msg(){


    if(isset($_SESSION['flash_msg'])){

        echo "<div class='{$_SESSION['flash_msg']['class']}'>{$_SESSION['flash_msg']['msg']}</div>";

        unset($_SESSION['flash_msg']);
    }
}
