<?php
/**
 * Created by PhpStorm.
 * User: Shi Tao
 * Date: 2/04/2018
 * Time: 6:59 PM
 */
function printHiTwice(){
    for ($x = 0; $x <2; $x++){
        echo '<h1>'.'HI!!'.'</h1><br>';
    }
}

function greets(string $name){
    return '<h1>'.'Bye '.$name.'</h1>';
}

// define a variable in the global scope to be used by the following function
$sideEffect = 'I\'m nasty';

/*
 * This function demonstrate the usage of $GLOBALS variable.
 * $GLOBALS is a member of superglobals set in PHP.
 * Superglobals are predefined variables in PHP core libraries,
 * similar to Global objects in Node.js core modules.
 * The other frequently used superglobals include:
 *  $_GET
 *  $_POST
 *  $_COOKIE
 *  $_SESSION
 */
function dirtySideEffect(){
    print '<h1>'.'i\'m doing something I\'m not supposed to do but I just feel like it.'.'</h1><br>';
    // change the variable outside this function BY reference. bad practice.
    $GLOBALS['sideEffect'] = $GLOBALS['sideEffect'].' but I like to be nasty.';
}