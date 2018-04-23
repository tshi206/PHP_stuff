<?php
    include_once "header.php";

    if (isset($_GET['first'])){
        $_SESSION['first'] = $_GET['first'];
    }
    if (isset($_GET['last'])){
        $_SESSION['last'] = $_GET['last'];
    }
    if (isset($_GET['uid'])){
        $_SESSION['uid'] = $_GET['uid'];
    }
?>
<section class="main-container">
    <div class="main-wrapper">
        <h2>SIGN UP</h2>
        <form class="signup-form" action="includes/signup_handler.php" method="post">
            <input type="text" name="first" placeholder="Firstname" value="<?php echo $first = $_SESSION['first'] ? $_SESSION['first'] : '' ?>">
            <input type="text" name="last" placeholder="Lastname" value="<?php echo $last = $_SESSION['last'] ? $_SESSION['last'] : '' ?>">
            <input type="email" name="email" placeholder="E-mail">
            <input type="text" name="uid" placeholder="Username" value="<?php echo $uid = $_SESSION['uid'] ? $_SESSION['uid'] : '' ?>">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submit">Sign up</button>
        </form>
    </div>
</section>

<?php
    include_once "footer.php";
?>
