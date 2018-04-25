<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arrays demo</title>
</head>
<body>
<?php
$data = array();
$data[] = "a"; // $data[] = ... is the same as appending the array, a little bit weird syntax
$data[] = 15;  // do not confuse it with $data = ..., which is re-assigning the $data variable
print_r($data);
echo '</br>';
$data = "oops"; // !!!re-assigning rather than appending!!!
print_r($data);

// another method to populate the array, i.e., appending it with some data
$data2 = array();
array_push($data2, "pushed");
array_push($data2, "pushed", 2, "more");
print_r($data2);
echo '</br>';

// another way
$data3 = ["a"=>1, 4=>"asd", "15"=>5378.52]; // another way to initialize array
$data3["x"] = 42; // insert an numeric element 42 with key equals string "x"
print_r($data3);
echo '</br>';

// OO way
include "MyArray.php";
var_dump((array) new MyArray([])); // ArrayObject when casting to arrays will be treated just like arrays
echo '</br>';

// more info see: http://php.net/manual/en/language.types.array.php

include_once "db_handler.php";
$myArray = new MyArray([]);
$sql = "select * from loginsystem.users;";
$numOfRows = mysqli_num_rows(mysqli_query($conn, $sql));
if ($numOfRows > 0) {
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $myArray->append($row);
    }
}
echo '</br>';echo '</br>';
print_r($myArray);
echo '</br>';echo '</br>';
print_r($myArray->__toArray());
echo '</br>';echo '</br>';
foreach ($myArray->__toArray() as $item) {
    print_r($item);
    echo '</br>';
}
echo '</br>';echo '</br>';
// spit out a particular column in the db via the key name as column name
foreach ($myArray->__toArray() as $item) {
    echo "__firstname: ".$item['user_first']."________lastname: ".$item['user_last']."________email: ".$item['user_email'];
    echo '</br>';
}

?>
</body>
</html>