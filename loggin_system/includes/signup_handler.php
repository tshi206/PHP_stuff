<?php

session_start(); // use session if you want to populate the signup form beforehand, e.g. after returning from an signup error
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

$urlOnSuccess = 'http://127.0.0.1/loggin_system/signup.php?signup=success'; // this can be set based on whatever
$urlOnFailure = 'http://127.0.0.1/loggin_system/signup.php?signup=error';
$urlOnMissingFields = 'http://127.0.0.1/loggin_system/signup.php?signup=empty';
$urlOnInvalidEmail = 'http://127.0.0.1/loggin_system/signup.php?signup=invalidemail';
$urlOnInvalidChar = 'http://127.0.0.1/loggin_system/signup.php?signup=invalidchar';

if (isset($_POST['submit'])) {

    include_once "db_handler.php";

    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    if (!$first || !$last || !$email || !$uid || !$pwd) {
        returnTo($urlOnMissingFields);
    } else if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
        returnTo($urlOnInvalidChar);
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        returnTo($urlOnInvalidEmail."&first=$first&last=$last&uid=$uid");
    } else {

        $sql = "SELECT * FROM users where user_uid = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            returnTo($urlOnFailure);
            exit();
        } else {
            // check if the uid has already been registered by someone else
            mysqli_stmt_bind_param($stmt, 's', $uid);
            $result = mysqli_stmt_get_result($stmt);
            if ($result->lengths != 0) {
                returnTo($urlOnFailure."&usertaken=true");
                exit();
            }
        }

        $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES (?, ?, ?, ?, ?);";

        // create a prepare statement
        $stmt = mysqli_stmt_init($conn);

        // prepare the prepare statement
        if (!mysqli_stmt_prepare($stmt, $sql)){
            returnTo($urlOnFailure);
        } else {

            // hashing the password
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, 'sssss', $first, $last, $email, $uid, $hashedPwd);
            $isSuccess = mysqli_stmt_execute($stmt);

            if ($isSuccess){
                // insert successfully
                $_SESSION['first'] = '';
                $_SESSION['last'] = '';
                $_SESSION['uid'] = '';
                returnTo($urlOnSuccess);
            } else {
                // insertion failed
                returnTo($urlOnFailure);
            }

        }

    }

} else {

    returnTo($urlOnFailure);
    exit();

}