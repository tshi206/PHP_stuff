<?php

// more info see: https://stackoverflow.com/questions/353803/redirect-to-specified-url-on-php-script-completion
ob_start(); // ensures anything dumped out will be caught.


include_once './DB_handler.php';

$url = 'http://127.0.0.1/DB_demo/index.php?signup=success'; // this can be set based on whatever

$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$uid = $_POST['uid'];
$pwd = $_POST['pwd']; // better hash it in the real world application

$sql3 = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES (
'$first', '$last', '$email', '$uid', '$pwd'
);";
$result3 = $loginsystem_query_unchecked_return_type($sql3); // note that $result is of type::boolean
if ($result3 == true){ // note that mysqli_query for INSERTION returns a boolean instead of a mysqli_result obj
    // insert successfully
    echo '<h2>'."done with the insertion".'</h2>';
} else {
    // insertion failed
    echo '<h2>'."oops. something went wrong...".'</h2>';
}

// clear out the output buffer
while (ob_get_status())
{
    ob_end_clean();
}

// no redirect. more info see: https://stackoverflow.com/questions/353803/redirect-to-specified-url-on-php-script-completion
header( "Location: $url" );