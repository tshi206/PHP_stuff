<?php
include 'head_and_nav.php';
?>

<section>
    <div class="someMainContent">
        <h1>Hi there!</h1>
        <?php
        printHiTwice();
        printByeTwice();
        echo greets('Mason');
        dirtySideEffect();
        echo $GLOBALS['sideEffect'];
        ?>
    </div>
    <?php
    include './functions/superglobals_post_and_get_demo.php';
    include './functions/superglobals_cookie_and_session_demo.php';
    ?>
</section>

</body>
</html>