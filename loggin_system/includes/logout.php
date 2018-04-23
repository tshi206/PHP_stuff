<?php
ob_start(); // ensures anything dumped out will be caught.

function returnTo($address){

    // clear out the output buffer
    while (ob_get_status())
    {
        ob_end_clean();
    }

    // no redirect.
    // more info see: https://stackoverflow.com/questions/353803/redirect-to-specified-url-on-php-script-completion
    header( "Location: $address" );
}

if (isset($_POST['submit'])) {
    session_start();
    session_unset();
    session_destroy();
    returnTo("../index.php");
}