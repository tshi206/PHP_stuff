<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<form method="get">
    <input type="text" name="person"  title="whocares"/>
    <button type="submit">Submit</button>
</form>

<?php
/**
 * Created by PhpStorm.
 * User: Shi Tao
 * Date: 25/03/2018
 * Time: 7:53 PM
 */
/*
echo "hello world!!!!!!!!!!!!";
echo "12";
echo 12;
echo 10 + 5;
print 5;
print "Mason";
*/
    $name = $_GET["person"] ? $_GET["person"] : 'Batman';
    echo $name . " is a super hero"; // php uses . instead of + to concatenate strings
    echo "<br>".strpos("Do you wanna play a game?", "game");
    echo "<br>true is " . true;
    echo "<br>false is " . (integer)false;

    $names = array("Batman", "Superman", "Flash", "Aquaman", 1, 2.5, 3.1415926, $name);
    echo $names;
    echo '<br>'.$names[7]." killed ".$names[1]."\n".$names[5]." times";

    echo '<br>'.(string)5**5; // 5^5

    print "<br>";

    /*
     * Two of the many comparison operators used by PHP are '==' (i.e. equal) and '===' (i.e. identical).
     * The difference between the two is that '==' should be used to check if the values of the two operands are equal
     * or not. On the other hand, '===' checks the values as well as the type of operands.
     * Duals: != (auto-casting, no type check), !== (strict type check)
     * equivalent: != is the same operator as <>
     */
    if ($name === $names[0]){
        echo "Batman is awesome";
    }else{
        echo "No one can beat Batman";
    }

    $x = 10;
    echo '<br>';
    echo ++$x; // return the new value after addition
    echo '<br>';
    echo $x++; // return the old value before addition
    echo '<br>';
    echo $x;

    $x = 10;
    echo '<br>';
    echo --$x; // return the new value after subtraction
    echo '<br>';
    echo $x--; // return the old value before subtraction
    echo '<br>';
    echo $x;

    /*
     * logical operators
     *  and, or, xor
     * equivalent shortcuts
     *  &&, ||
     * all the above are legal
     * note that 'xor' has no alternate symbols
     */
?>

</body>
</html>