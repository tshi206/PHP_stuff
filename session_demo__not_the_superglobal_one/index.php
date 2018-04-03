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

<?php
/*
 * This demo is about the Session facilities in PHP,
 * the details of superglobal $_SESSION is depicted in the 'include_demo'
 */

/*
 * The ultimate goal for creating such $_SESSION variable is to share information among our web pages in a secure way.
 * However, just initializing a $_SESSION variable does not imply that our web service will remember it. In fact, in
 * order to share the $_SESSION variable we need to first start our session, otherwise it will be nothing more than an
 * ordinary variable that is scoped by its document.
 */
$_SESSION['username'] = 'admin';
echo $_SESSION['username'];
?>

</body>
</html>