<?php
include_once './includes/DB_handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DB demo</title>
</head>
<body>

<?php
// to connect to a DB just reference the mysqli object, like the following
// $conn;
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}
echo $conn->host_info . "\n";
?>

</body>
</html>