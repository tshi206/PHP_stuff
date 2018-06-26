<?php
/**
 * Created by PhpStorm.
 * User: Shi Tao
 * Date: 26/06/2018
 * Time: 4:40 PM
 */
include 'header.php';
?>

<h1>Article page</h1>

<div class="article-container">
    <?php
    $title = mysqli_real_escape_string($conn, $_GET['title']);
    $date = mysqli_real_escape_string($conn, $_GET['date']);

    $sql = "select * from article where a_title='$title' and a_date='$date' ;";
    $result = mysqli_query($conn, $sql);
    $resultsNum = mysqli_num_rows($result);

    if ($resultsNum > 0){
//        while ($row = mysqli_fetch_assoc($result)) {
//            // this works, below is just another option.
//            // both equivalent
//        }
        while ($row = $result->fetch_assoc()) {
            echo
            "<div>
                <h3>".$row['a_title']."</h3>
                <p>".$row['a_text']."</p>
                <p>".$row['a_date']."</p>
                <p>".$row['a_author']."</p>
            </div>";
        }
    }

    ?>
</div>

</body>
</html>