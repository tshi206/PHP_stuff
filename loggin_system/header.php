<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <title>Logging Sys</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <nav>
        <div class="main-wrapper">
            <ul>
                <li><a href="index.php">Home</a> </li>
            </ul>
            <div class="nav-login">
                <?php
                    if (isset($_SESSION['u_uid'])) {
                        echo '<form action="includes/logout.php" method="post">
                                  <button type="submit" name="submit">Log out</button>
                              </form>';
                    } else {
                        echo '<form action="includes/login_handler.php" method="post">
                                  <input type="text" name="uid" placeholder="Username/email">
                                  <input type="password" name="pwd" placeholder="Password">
                                  <button type="submit" name="submit">Login</button>
                              </form>
                              <a href="signup.php">Sign up</a>';
                    }
                ?>
            </div>
        </div>
    </nav>
</header>