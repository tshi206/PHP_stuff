<?php
// Start a session and store the $_SESSION variable inside this session.
// This will allow us to access the same $_SESSION variable on all pages inside our website.
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>insert with prepare statement demo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
include 'header.php';
?>

<h2>Sign Up with error handler and prepare statement</h2>
<form action="includes/signup_with_prepare_statement.php" method="post" class="main main-center main-login input-group">
    <input type="text" name="first" placeholder="Firstname"
           value="<?php echo $first = $_SESSION['first'] ? $_SESSION['first'] : '' ?>"><br>
    <input type="text" name="last" placeholder="Lastname"
           value="<?php echo $last = $_SESSION['last'] ? $_SESSION['last'] : '' ?>"><br>
    <input type="text" name="email" placeholder="E-mail"><br>
    <input type="text" name="uid" placeholder="Username"
           value="<?php echo $uid = $_SESSION['uid'] ? $_SESSION['uid'] : '' ?>"><br>
    <input type="password" name="pwd" placeholder="Password"><br>
    <button type="submit" name="submit">Sign up</button>
</form>

</body>
</html>