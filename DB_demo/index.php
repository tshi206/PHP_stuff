<?php
include_once './includes/DB_handler.php';
?>
<?php
// Start a session and store the $_SESSION variable inside this session.
// This will allow us to access the same $_SESSION variable on all pages inside our website.
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DB demo</title>
</head>
<body>
<?php
include 'header.php';

if (isset($_GET['first'])){
    $_SESSION['first'] = $_GET['first'];
}
if (isset($_GET['last'])){
    $_SESSION['last'] = $_GET['last'];
}
if (isset($_GET['uid'])){
    $_SESSION['uid'] = $_GET['uid'];
}
?>

<?php
// to connect to a DB just reference the mysqli object, like the following:
// example 1: $conn -> <some_methods/fields>;
// example 2:
// if ($conn->connect_errno) {
//     echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
// }
// echo $conn->host_info . "\n";
check_connection_to_loginsystem($conn);

$sql1 = "select * from users;";
$result1 = $loginsystem_query($sql1); // this is a call to a function literal, note that $result is of type::mysqli_result

if ($result1 != false){ // permit auto-casting because there can be potentially a returned FALSE or a mysqli_result::obj
    $numberOfRows = mysqli_num_rows($result1);
    if ($numberOfRows < 1){
        echo '<h1>'.'empty result set'.'</h1>';
    }else{
        foreach ($result1->fetch_all() as $row){ // fetch_all() is a method on mysqli_result::objects
            // for documentation on fetch_all() and other methods check function::overloaded_fetches in DB_handler.php
            // because tooltips/type-inferring is failing on closures (aka function literals) no idea why :(
            echo '<h2>';
            foreach ($row as $item){
                echo "\n".$item."\n";
            }
            echo '</h2>';
        }
    }
}
unset($row);


// The above approach is a rather OO-style solution as it is using methods on the returned object.
// An alternative solution that is more procedural can be implemented as follow:
$sql2 = "select * from users;";
$result2 = $loginsystem_query($sql2); // this is a call to a function literal, note that $result is of type::mysqli_result
$numberOfRows = mysqli_num_rows($result2);
// error handling still follows the same idea, here the boolean check on the $result2 is omitted for simplicity
if ($numberOfRows > 0){
    // mysqli_fetch_assoc($result2) returns an associative array that corresponds to the fetched row
    // and moves the internal data pointer ahead. While a row of data exists, put that row in $row as an associative array.
    // Note that the following while condition is a special case due to the existence of internal pointer and the
    // implementation encapsulated by the function::mysqli_fetch_assoc. Generally, assigning a ordinary array to the variable
    // as a expression in while clause will result in an infinite loop.
    while ($row = mysqli_fetch_assoc($result2)){
        echo '<h2>';
        foreach ($row as $key => $value){
            echo "\n[".$key.": ".$value."]\n";
        }
        echo '</h2>';
    }
}
?>

<?php
// just to show how to get the full url in an elegant way
$fullURL= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo $fullURL;
// The following approach will erase all previously filled in fields upon failure
/*
if (strpos($fullURL, "signup=empty")){
    echo '<h2 style="color: red; background: grey">'.'You did not fill in all the fields'.'</h2>';
} else if (strpos($fullURL, "signup=invalidchar")){
    echo '<h2 style="color: red; background: grey">'.'Type valid words pls'.'</h2>';
} else if (strpos($fullURL, "signup=invalidemail")){
    echo '<h2 style="color: red; background: grey">'."Can't you type in a legit email address???".'</h2>';
} else if (strpos($fullURL, "signup=error")){
    echo '<h2 style="color: red; background: grey">'.'You screwed it up lol'.'</h2>';
}
else if (strpos($fullURL, "signup=success")){
    echo '<h2 style="color: limegreen; background: grey">'.'Well done buddy'.'</h2>';
}
*/

// an alternative way to do the error handling (equivalent to the above)
// this will preserve previously filled in fields even after a failure
if (!isset($_GET['signup'])){
    echo '<h2 style="color: limegreen; background: grey">'.'Good day Uh?'.'</h2>';
    exit();
} else {
    $signupStatus = $_GET['signup'];
    switch ($signupStatus){
        case "empty":
            echo '<h2 style="color: red; background: grey">'.'You did not fill in all the fields'.'</h2>';
            break;
        case "invalidchar":
            echo '<h2 style="color: red; background: grey">'.'Type valid words pls'.'</h2>';
            break;
        case "invalidemail":
            echo '<h2 style="color: red; background: grey">'."Can't you type in a legit email address???
            I'm giving you a second chance. Go back and re type it again. NOW!!!!".'</h2>';
            break;
        case "error":
            echo '<h2 style="color: red; background: grey">'.'You screwed it up lol'.'</h2>';
            break;
        case "success":
            echo '<h2 style="color: limegreen; background: grey">'.'Well done buddy'.'</h2>';
            break;
    }
}
?>

</body>
</html>