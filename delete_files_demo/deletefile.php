<?php
/**
 * Created by PhpStorm.
 * User: Shi Tao
 * Date: 25/06/2018
 * Time: 11:50 AM
 */
$filenames = $_POST["filename"];

$removeCommaWithSpaces = preg_replace("/,\s+/", ",", $filenames);

//print_r($removeCommaWithSpaces);

$allFileNames = explode(",", $removeCommaWithSpaces);

//print_r($allFileNames);

for ($i = 0; $i < count($allFileNames); $i++){
    if (!file_exists("uploads/".$allFileNames[$i])){
        header("Location: index.php?delete_error=file_not_exist");
        exit();
    }
}

$isSuccess = true;
foreach ($allFileNames as $file){
    $path = "uploads/".$file;
    if (!unlink($path)) {
        echo "oops! can't delete: ".$path;
        $isSuccess = false;
        break;
    }
}

header("Location: index.php?deleted=".($isSuccess? "true" : "false"));