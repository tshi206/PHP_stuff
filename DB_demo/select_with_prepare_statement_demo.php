<?php
include 'includes/DB_handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select with prepare statement demo</title>
</head>
<body>
<?php
include 'header.php'
?>

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
$var1 = 'Bruce';
$var2 = 14;

// create a template for the prepare statement
$sql1 = "select * from users where user_first=? AND user_id=?;";

// create a prepare statement
$stmt = mysqli_stmt_init($conn); // ignore the warning, we don't use the method, we use the function instead

// prepare the prepare statement
if (!mysqli_stmt_prepare($stmt, $sql1)){
    echo '<h2>'.'SQL statement failed'.'</h2>';
} else {
    // bind parameters to the placeholders '?'
    mysqli_stmt_bind_param($stmt, 'si', $var1, $var2);
    // each 's' and 'i' is going to substitute a placeholder '?' in the respective order
    // since we have two '?', we supply two characters in the second parameter,
    // and their types are string and integer, respectively
    // note that 's' means string type, 'i' for integer, 'b' for BLOB, and 'd' for double

    // now run the prepared statement in the database with specified parameters
    mysqli_stmt_execute($stmt);

    // get the results back
    // note that the return types can be either boolean::FALSE upon SELECT Error or type::mysqli_result
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)){
        echo '<h2>';
        foreach ($row as $key => $value){
            echo "\n[".$key.": ".$value."]\n";
        }
        echo '</h2>';
    }
}

?>
</body>
</html>