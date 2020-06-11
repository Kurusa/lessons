<?php
include "connection.php";

mysqli_query($connection, "SET NAMES utf8");

$film_select = "SELECT name, about, url FROM films ORDER BY date DESC ";
$result = mysqli_query($connection, $film_select);
while ($row = mysqli_fetch_array($result)) {
    $nl2br = nl2br($row['about']);
    ?>


<div class="for_film">
    <div class="movie_pic">
        <img width="215" src="<?=$row['url']?>">
    </div>

    <div class="movie_name">
        <?= $row['name'] ?>
    </div>

    <div class="movie_about"><?= $row['about']?></div>

    <div class="data"> <?= $row['data']?> </div>
</div>

<?php } ?>
