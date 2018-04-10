<?php
/*
 * mysqli_real_escape_string() only escapes the string you send to the database, where as prepared statements
 *  works differently by sending the query to the database before sending the actual data. This means that we
 *  don't need to escape the string we send, because the data isn't send together with a new query. Therefore
 *  mysqli_real_escape_string() is obsolete. And because we send the query before the data, it makes it more
 * secure since the user doesn't get the chance to "mess" with our query.﻿
 * In fact, the parameters in the prepared statements are sent via different protocols and only treated as plain
 * characters, hence SQL injection is prevented.
 */
include 'utils.php'; // example of a trivial debug logger

session_start();

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

// more info see: https://stackoverflow.com/questions/353803/redirect-to-specified-url-on-php-script-completion
ob_start(); // ensures anything dumped out will be caught.


include_once './DB_handler.php';

$urlOnSuccess = 'http://127.0.0.1/DB_demo/index.php?signup=success'; // this can be set based on whatever
$urlOnFailure = 'http://127.0.0.1/DB_demo/index.php?signup=error';
$urlOnMissingFields = 'http://127.0.0.1/DB_demo/index.php?signup=empty';
$urlOnInvalidEmail = 'http://127.0.0.1/DB_demo/index.php?signup=invalidemail';
$urlOnInvalidChar = 'http://127.0.0.1/DB_demo/index.php?signup=invalidchar';

if (isset($_POST['submit'])) {

    $first = empty($_POST['first']) ? false : $_POST['first'];
    $last = empty($_POST['last']) ? false : $_POST['last'];
    $email = empty($_POST['email']) ? false : $_POST['email'];
    $uid = empty($_POST['uid']) ? false : $_POST['uid'];
    $pwd = empty($_POST['pwd']) ? false : $_POST['pwd']; // better hash the password in the real world application

    // ensure all form fields has been filled
    // actually, the explicit converting as the above ternary operators do is not necessary, PHP will auto cast variables
    // to match with the desirable types of whichever operator whenever required.
    // the following if-condition is equivalent to:
    //      $first = $_POST['first']; // explicit type converting is not required
    //      $last = $_POST['last'];
    //      $email = $_POST['email'];
    //      $uid = $_POST['uid'];
    //      $pwd = $_POST['pwd'];
    //      if (!$first || !$last || !$email || !$uid || !$pwd) { ... } else { ... }
    // To see how the boolean value of a variable is determined after auto casting, see:
    //      http://php.net/manual/en/language.types.boolean.php
    if (!$first || !$last || !$email || !$uid || !$pwd) {
        returnTo($urlOnMissingFields);
    } else if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
        returnTo($urlOnInvalidChar);
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        returnTo($urlOnInvalidEmail."&first=$first&last=$last&uid=$uid");
    } else {

        $sql4 = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES (?, ?, ?, ?, ?);";

        // create a prepare statement
        $stmt = mysqli_stmt_init($conn);

        // prepare the prepare statement
        if (!mysqli_stmt_prepare($stmt, $sql4)){
            echo '<h2>'.'SQL statement failed'.'</h2>';
            returnTo($urlOnFailure);
        } else {
            // bind parameters to the placeholders '?'
            // the order of parameter variables must be the same as the order of the placeholders
            mysqli_stmt_bind_param($stmt, 'sssss', $first, $last, $email, $uid, $pwd);
            // each 's' and 'i' is going to substitute a placeholder '?' in the respective order
            // since we have two '?', we supply two characters in the second parameter,
            // and their types are string and integer, respectively
            // note that 's' means string type, 'i' for integer, 'b' for BLOB, and 'd' for double

            // now run the prepared statement in the database with specified parameters
            $isSuccess = mysqli_stmt_execute($stmt);

            /*
             * UPDATE:
             *
             * DO NOT USE THE FOLLOWING FOR ERROR CHECKING!!!!!!!!
             *
             * mysqli_stmt_get_result() is only used to retrieve a mysqli_result obj, hence it is not supposed to
             * use to retrieve the result from UPDATE, DELETE, and INSERT queries because they do not return any
             * result set. If used, the return variable for this function will always be FALSE. Therefore the following
             * if-condition will always be evaluated to FALSE.
             *
             * To work with queries that do not have any result set returned, use the return variable from
             *  mysqli_stmt_execute() instead. mysqli_stmt_execute() returns a boolean which is sufficient for error
             * checking of the INSERT, UPDATE, or DELETE queries.
             *
             *  mysqli_stmt_execute() returns TRUE on success or FALSE on failure.
             *
             * If the statement is UPDATE, DELETE, or INSERT, the total number of affected rows can be determined by
             *  using the mysqli_stmt_affected_rows() function. Likewise, if the query yields a result set the
             *  mysqli_stmt_fetch() function is used.
             */
//        // get the result back
//        $result = mysqli_stmt_get_result($stmt); // don't use this for insertion, won't work
//        if ($result){
//            // insert successfully
//            echo '<h2>'."done with the insertion".'</h2>';
//            returnTo($urlOnSuccess);
//        } else {
//            // insertion failed
//            echo '<h2>'."oops. something went wrong...".'</h2>';
//            returnTo($urlOnFailure);
//        }

            if ($isSuccess){
                // insert successfully
                echo '<h2>'."done with the insertion".'</h2>';
                $_SESSION['first'] = '';
                $_SESSION['last'] = '';
                $_SESSION['uid'] = '';
                returnTo($urlOnSuccess);
            } else {
                // insertion failed
                echo '<h2>'."oops. something went wrong...".'</h2>';
                returnTo($urlOnFailure);
            }
        }
    }

} else {

    returnTo($urlOnFailure);

}
