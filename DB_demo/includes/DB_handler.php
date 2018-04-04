<?php
/**
 * Created by PhpStorm.
 * User: Shi Tao
 * Date: 3/04/2018
 * Time: 11:15 PM
 */

$dbServername = 'localhost'; // hostname on which the db instance sits
$dbUsername = 'root'; // default by xampp, required to be changed if using online hosting service or customized db setting
$dbPassword = ""; // default by xampp, required to be changed if using online hosting service or customized db setting
$dbName = 'loginsystem'; // name of the db inside the dbms

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName, '3306');

// see PHP anonymous function documentation for inheriting variables from the parent scope.
// note that PHP does not support union type.
$loginsystem_query = function (string $sqlStatement) use ($conn) : mysqli_result {
    return mysqli_query($conn, $sqlStatement);
};

/*
 * overloaded fetches implementation.
 * featuring:
 * fetch_array, fetch_assoc, fetch_fields, fetch_row
 * default:
 * fetch_all
 * unimplemented:
 * fetch_object, free, close, data_seek, field_seek, etc.
 */
function overloaded_fetches(mysqli_result $result, string $fetch_type = 'fetch_all'){
    switch ($fetch_type){
        case 'fetch_array':
            return $result->fetch_array();
            break;
        case 'fetch_assoc':
            return $result->fetch_assoc();
            break;
        case 'fetch_fields':
            return $result->fetch_fields();
            break;
        case 'fetch_row':
            return $result->fetch_row();
            break;
        default:
            return $result->fetch_all();
    }
};

function check_connection_to_loginsystem($conn){
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    echo $conn->host_info . "\n";
}