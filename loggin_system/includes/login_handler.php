<?php

session_start();
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

    include "db_handler.php";

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    // error handler
    if (empty($uid) || empty($pwd)) {

        returnTo("../index.php?login=empty");
        exit();

    } else {
        $email = filter_var($uid, FILTER_VALIDATE_EMAIL);
        if ($email){
            $sql = "select * from loginsystem.users where user_email = '$email'";
        } else {
            $sql = "select * from loginsystem.users where user_uid = '$uid'";
        }
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            returnTo("../index.php?login=error");
            exit();
        }

        if ($row = mysqli_fetch_assoc($result)) {
            $pwdCheck = password_verify($pwd, $row['user_pwd']);
            if (!$pwdCheck) {
                returnTo("../index.php?login=error");
                exit();
            } else {
                $_SESSION['u_pk'] = $row['user_id'];
                $_SESSION['u_first'] = $row['user_first'];
                $_SESSION['u_last'] = $row['user_last'];
                $_SESSION['u_email'] = $row['user_email'];
                $_SESSION['u_uid'] = $row['user_uid'];
                returnTo("../index.php?login=success");
                exit();
            }
        }

    }

} else {
    returnTo("../index.php?login=error");
    exit();
}