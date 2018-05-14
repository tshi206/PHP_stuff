<?php

include_once "dbh.php";

$first = $_POST['first'];
$last = $_POST['last'];
$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

$sql = "insert into user (first, last, username, password)
        VALUES ('$first', '$last', '$uid', '$pwd')";
mysqli_query($conn, $sql);
unset($sql);
$sql = "select * from user where username = '$uid' AND first = '$first';";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $userid = $row['id'];
        $sql1 = "insert into profileimg (userid, status) 
                  VALUES ('$userid', '1');";
        mysqli_query($conn, $sql1);
        header("Location: index.php");
    }
} else {
    echo 'You have an error!';
}