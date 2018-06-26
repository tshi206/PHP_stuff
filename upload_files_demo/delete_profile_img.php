<?php
/**
 * Created by PhpStorm.
 * User: Shi Tao
 * Date: 24/06/2018
 * Time: 1:32 PM
 */

session_start();
include_once 'dbh.php';
$sessionid = $_SESSION['id'];

$filename = "uploads/profile_".$sessionid.".*";
$fileinfo = glob($filename);

//print_r($fileinfo);
$fileext = explode(".", $fileinfo[0])[1];

//print_r($fileext);
$file = explode(".", $filename)[0].".".$fileext;

print_r($file);

if (!unlink($file)){
    echo "<div style=\"text-align: center;\"><h1>ERROR: deletion unsuccessful</h1></div>";
}else{
    echo "<div style=\"text-align: center;\"><h1>COMPLETE: profile image deleted successfully</h1></div>";
}

$sql = "UPDATE profileimg SET status=1 where userid=".$sessionid.";";
if (!mysqli_query($conn, $sql)){
    echo "<div style=\"text-align: center;\"><h1>ERROR: cannot remove `profileimg` row in DB</h1></div>";
}else{
    header("Location: index.php?delete_success");
}