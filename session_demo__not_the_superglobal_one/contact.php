<?php
// Start a session and store the $_SESSION variable inside this session.
// This will allow us to access the same $_SESSION variable on all pages inside our website.
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Demo</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
include 'nav.php';
?>
<h1>I'm the contact</h1>
<?php
/**
 * Created by PhpStorm.
 * User: Shi Tao
 * Date: 3/04/2018
 * Time: 8:22 PM
 */
// access the 'username' created in another document via the shared $_SESSION variable. (see 'session_start()' above)
echo $_SESSION['username'];
?>
</body>
</html>
