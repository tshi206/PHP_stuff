<?php
/*
 * make sure php codes referenced by another document via 'include'
 * are loaded first (before any other document types, i.e., html,
 * if those types are in the same file as php codes, as shown in this
 * example)
 */
include './functions/user_functions.php';

// the following is just an alternative to include stuff
include_once './functions/user_functions_1.php'; // only include once, duplicate include of the same document will be eliminated
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>who cares</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="">nav1</a></li>
            <li><a href="">nav2</a></li>
            <li><a href="">nav3</a></li>
            <li><a href="">nav4</a></li>
        </ul>
    </nav>
</header>
