<?php
/**
 * Created by PhpStorm.
 * User: Shi Tao
 * Date: 26/06/2018
 * Time: 3:40 PM
 */
include 'header.php'
?>

<h1>Search page</h1>
<div class="article-container">
    <?php
    if (isset($_POST['submit-search'])){
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "select * from article where
            a_title like '%$search%' or 
            a_text like '%$search%' or 
            a_author like '%$search%' or 
            a_date like '%$search%' ;";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        echo "<h2>There are ".$num." results!</h2>";

        if ($num > 0) {
            while ($row = $result->fetch_assoc()) {
                echo
                    "<a href='article.php?title=".$row['a_title']."&date=".$row['a_date']."'>
                    <div>
                        <h3>".$row['a_title']."</h3>
                        <p>".$row['a_text']."</p>
                        <p>".$row['a_date']."</p>
                        <p>".$row['a_author']."</p>
                    </div>
                    </a>";
            }
        } else {
            echo "<h1>there are no results matching your search!</h1>";
        }

    }
    ?>
</div>

</body>
</html>