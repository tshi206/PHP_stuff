<?php
/*
 * $GLOBALS
 * $_POST
 * $_GET
 * $_COOKIE
 * $_SESSION
 *
 * Cookies are saved on client-side, essentially on the local hard disks, hence they are easily got hacked.
 * So, in practice, cookies are used to save some non-critical information e.g., shopping preference on Amazon.
 * On the other hand, sessions are more secured than cookies because they are stored on server-side and they
 * will be automatically destroyed as soon as the connection terminates i.e. the browser is closed by the user.
 * So, in practice, sessions can be used to store critical information like login details and these information
 * will only be available to the remote services until the connection shutdowns. By the way, login details are
 * usually hashed and persisted in databases behind remote services.
 */

// create a cookie that will be available for one day
// setcookie :: (name : string, value : string, expire : number, [optional params ...]) -> boolean
setcookie("myDeliciousCookie", hash('sha256', 'it tastes good'), time() + 86400);

// to destroy a cookie, give its expiry time a negative value, i.e. a point in time in the past
setcookie("myDisgustingCookie", hash('sha256', 'it tastes like chewing a piece of plastic bag'),
    time() - 86400);

echo '<h1>'.$_COOKIE['myDeliciousCookie'].'</h1>';

// create a session. name the session by 'myLovelySession' and the session stores an imaginary user id in DB.
// hacker gon see the value stored in cookies but they cannot see anything stored inside the $_SESSION variable.
// essentially, a session is a collection of key/value pairs, or in another term, name/value pairs.
$_SESSION['myLovelySession'] = "HACKERS CAN'T SEE ME AYE";

echo '<h1>'.hash('sha256', $_SESSION['myLovelySession']).'</h1>';