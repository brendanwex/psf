<?php
/**
 * Project: psf
 * User: Brendan Doyle / brendan@2cloud.ie
 * Date: 10/07/2019
 * Time: 16:40
 */


function error_404(){

    header("HTTP/1.0 404 Not Found");
    include(ERROR_VIEW);
    die();



}