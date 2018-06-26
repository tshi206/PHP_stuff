<?php
    session_start();
    include_once 'dbh.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>upload files demo</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<?php

$sql = "select * from USER";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $sql1 = "select * from profileimg WHERE userid = '$id';";
        $resultImg = mysqli_query($conn, $sql1);
        while ($rowImg = mysqli_fetch_assoc($resultImg)) {
            echo "<div class='user-container'>";
            if ($rowImg['status'] == 0) {
                // mt_rand() make some random number to stop the browser caching the old image by changing the file name
                $filebasename = glob("uploads/profile_" . $id . ".*")[0];
                $imgSource = $filebasename.'?'.mt_rand();
                echo "<img src=$imgSource>";
            } else {
                echo "<img src='uploads/profile_default.png'>";
            }
            echo "<p>".$row['username']."</p>";
            echo "</div>";
        }
    }
} else {
    echo "There are no users yet!";
}

if (isset($_SESSION['id'])) {
    if ($_SESSION['id'] == 1) {
        echo 'You are logged in as user #1';
    }
    echo "<!-- enctype specifies how the form data should be encoded -->
            <form action=\"upload.php\" method=\"post\" enctype=\"multipart/form-data\">
                <input type=\"file\" name=\"file\">
                <button type=\"submit\" name=\"submit\">Upload</button>
            </form>";
    echo "<!-- delete profile img and restore the default img -->
            <form action=\"delete_profile_img.php\" method=\"post\">
                <button type=\"submit\" name=\"submit\">Delete profile image</button>
            </form>";
} else {
    echo 'You are not logged in';
    echo "<form action='signup.php' method='post'>
                <input type='text' name='first' placeholder='First name'>
                <input type='text' name='last' placeholder='Last name'>
                <input type='text' name='uid' placeholder='Username'>
                <input type='password' name='pwd' placeholder='Password'>
                <button type='submit' name='submitSignup'>Sign Up</button>
            </form>";
}
?>

<p>Login as the first user</p>

<form action="login.php" method="post">
    <button type="submit" name="submitLogin">Login</button>
</form>

<p>Logout</p>

<form action="logout.php" method="post">
    <button type="submit" name="submitLogout">Logout</button>
</form>

</body>
</html>