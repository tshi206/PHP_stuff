<?php

// more info see: https://stackoverflow.com/questions/353803/redirect-to-specified-url-on-php-script-completion
ob_start(); // ensures anything dumped out will be caught.


include_once './DB_handler.php';

$url = 'http://127.0.0.1/DB_demo/index.php?signup=success'; // this can be set based on whatever

$first = mysqli_real_escape_string($conn, $_POST['first']); // prevent users to inject SQL statement into our form
$last = mysqli_real_escape_string($conn, $_POST['last']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$uid = mysqli_real_escape_string($conn, $_POST['uid']);
$pwd = mysqli_real_escape_string($conn, $_POST['pwd']); // better hash the password in the real world application

$sql4 = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES (?, ?, ?, ?, ?);";

// create a prepare statement
$stmt = mysqli_stmt_init($conn);

// prepare the prepare statement
if (!mysqli_stmt_prepare($stmt, $sql4)){
    echo '<h2>'.'SQL statement failed'.'</h2>';
} else {
    // bind parameters to the placeholders '?'
    // the order of parameter variables must be the same as the order of the placeholders
    mysqli_stmt_bind_param($stmt, 'sssss', $first, $last, $email, $uid, $pwd);
    // each 's' and 'i' is going to substitute a placeholder '?' in the respective order
    // since we have two '?', we supply two characters in the second parameter,
    // and their types are string and integer, respectively
    // note that 's' means string type, 'i' for integer, 'b' for BLOB, and 'd' for double

    // now run the prepared statement in the database with specified parameters
    mysqli_stmt_execute($stmt);

    // get the result back
    $result = mysqli_stmt_get_result($stmt); // note that $result is of type::boolean for insertion
    if ($result == true){ // note that mysqli_query for INSERTION returns a boolean instead of a mysqli_result obj
        // insert successfully
        echo '<h2>'."done with the insertion".'</h2>';
    } else {
        // insertion failed
        echo '<h2>'."oops. something went wrong...".'</h2>';
    }
}

// clear out the output buffer
while (ob_get_status())
{
    ob_end_clean();
}

// no redirect. more info see: https://stackoverflow.com/questions/353803/redirect-to-specified-url-on-php-script-completion
header( "Location: $url" );