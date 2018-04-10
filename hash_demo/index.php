<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>hash and dehash demo</title>
</head>
<body>
<?php
echo $dummypwd = "adummypassword";
echo "<br>";
echo $somejunk = password_hash("adummypassword", PASSWORD_BCRYPT); // PASSWORD_BCRYPT == PASSWORD_DEFAULT,
// and salt has been builtin in password_hash()
// note that this is not a cryptographic hash function since each time you run the password_hash on an identical input
//  it yields a different result. (however it is a one-way function so still safe enough)
// in addition, its hash result requires at least 256 chars so make the varchar(256) or equivalent is set if using SQL DB

// dehash it now
echo "<br>";
echo password_verify($dummypwd, $somejunk) ? "LOL they match" : "oops, wrong password???";

?>
</body>
</html>