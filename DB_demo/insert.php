<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SQL_INSERT_DEMO</title>
</head>
<body>
<?php
include 'header.php';
?>

<form action="includes/signup_handler.php" method="post">
    <input type="text" name="first" placeholder="Firstname"><br>
    <input type="text" name="last" placeholder="Lastname"><br>
    <input type="text" name="email" placeholder="E-mail"><br>
    <input type="text" name="uid" placeholder="Username"><br>
    <input type="password" name="pwd" placeholder="Password"><br>
    <button type="submit" name="submit">Sign up</button>
</form>

</body>
</html>