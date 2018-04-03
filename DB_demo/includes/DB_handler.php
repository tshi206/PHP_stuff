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