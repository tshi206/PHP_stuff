<?php
include 'header.php';
?>
<form action="search.php" method="post">
    <input type="text" name="search" placeholder="Search..." >
    <button type="submit" name="submit-search">Search</button>
</form>

<h1>Front page</h1>
<h2>All articles:</h2>

<div class="article-container">
    <?php
    $sql = "select * from article;";
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