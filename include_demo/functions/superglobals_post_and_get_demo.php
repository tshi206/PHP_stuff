<?php
/*
 * $GLOBALS
 * $_POST
 * $_GET
 * $_COOKIE
 * $_SESSION
 */
$myGet = $_GET['superhero'] ? '<H1>'.$_GET['superhero'].' SAYS HI'.'</H1>' : '<H1>'.'no GET request for now'.'</H1>';
echo $myGet;
$myPost = $_POST['supervillain'] ? '<H1>'.$_POST['supervillain'].' SAYS HI'.'</H1>' : '<H1>'.'no POST request for now'.'</H1>';
echo $myPost;
?>

<br>
<form method="get">
    <input type="hidden" name="superhero" value="Batman">
    <button type="submit"> PRESS ME TO GET!</button>
</form>
<br>
<form method="post">
    <input type="hidden" name="supervillain" value="Joker">
    <button type="submit"> PRESS ME TO POST!</button>
</form>