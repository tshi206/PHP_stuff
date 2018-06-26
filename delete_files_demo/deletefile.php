<?php
/**
 * Created by PhpStorm.
 * User: Shi Tao
 * Date: 25/06/2018
 * Time: 11:50 AM
 */
$path = "uploads/cat.jpg";
if (!unlink($path)) {
    echo "oops! cant delete that";
} else {
    header("Location: index.php?deleted");
}