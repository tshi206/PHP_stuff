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

    $names = array("Batman", "Superman", "Flash", "Aquaman", 1, 2.5, 3.1415926, $name, 'Nite Owl', 'Silk Spectre', "Dr. Manhattan", "Rorschach", "Ozymandias", "The Comedian");
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
    echo '<br>';

    /*
     * logical operators
     *  and, or, xor
     * equivalent shortcuts
     *  &&, ||
     * all the above are legal
     * note that 'xor' has no alternate symbols
     */

    echo '<br>'."while loop".'<br>';

    $x = 0;
    while ($x < count($names)) {
        echo $names[$x].'<br>';
        $x++;
    }

    echo '<br>'."do while loop".'<br>';

    $x = 0; // variables in PHP are not lexically scoped to the nearest function/block
    do{
        echo $names[$x].'<br>';
        $x++;
    }while ($x < count($names));

    echo '<br>'."for (\$x = 0; \$x < count(\$names); \$x++)".'<br>';

    for ($x = 0; $x < count($names); $x++){
        echo $names[$x].'<br>';
    }

    echo '<br>'."foreach (\$names as &\$value)".'<br>';

    /*
     * In order to be able to directly modify array elements within the loop precede $value with &.
     * In that case the value will be assigned by reference (side-effect).
     * Without &, the $value will be assigned by value (or, copy), thus, side-effect free.
     */
    foreach ($names as &$value) {
        // the following (commented out) will change the content of the original array
        $value = $value.'<br>';
        echo $value;
    }

    echo '<br>'.'$value is now: ';
    print $value;

    // because the $value is not bound to the nearest lexical block, it will still point to the last key value
    // even after the loop so one way to break the old reference is by the following:
    unset($value);
    // if the same variable is going to be reused later, you'd better break the reference with the last element
    // otherwise unexpected behaviour will occur

    echo '<br>'."foreach (\$names as \$key => \$value)".'<br>';

    /*
     * Note that $key and $value are re-initialized in the following block automatically.
     * Essentially, $key represents the associated key and $value represents the associated value and
     * they can be named with whatever variable name.
     * The underlying syntactical specification is of the following:
     *      foreach (<associative_array> as <key_name> => <key_value>) {...}
     *    <key_name> and <key_value> are initialized for each foreach loop construct while they are not
     *    bound to the loop's scope.
     * associative array is a PHP type where elements are stored in key-value pair. All PHP array are
     * essentially associative array where the keys (indices) are EITHER generated by default from 0 to n
     * in a typical numeric array like array(1,2,3,4,5) with default keys(0,1,2,3,4), OR given as named keys
     * as shown in the following example of an associative array:
     *      array('sam' => 'accountant', 'Jane' => 33, 'David' => 'film maker', 12 => 'apples')
     *      where keys('sam', 'Jane', 'David', 12)
     *            values('accountant', 33, 'film maker', 'apples')
     */
    foreach ($names as $key => $value){
        echo '<br>'."{$key} => {$value} ";
        print_r($names);
        echo '<br>';
    }

    print '<br>';

    $y = 100; // global y

    function calcSeventyFivePercent($y){ // local y bound to the nearest function
        $new_y = $y * 0.75;
        echo "75% of ".$y." is ".$new_y;
    }

    calcSeventyFivePercent($y); // call the function
    print '<br>';
    calcSeventyFivePercent($y); // call it twice
    print '<br>';
    calcSeventyFivePercent(500); // call it with customized parameter
    print '<br>';
    calcSeventyFivePercent(3.1415926); // call it with customized parameter
    print '<br>';

?>

</body>
</html>