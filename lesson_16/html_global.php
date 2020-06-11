<?php
session_start();

include('connection.php');
mysqli_query($connection, "SET NAMES utf8");


?>


<!DOCTYPE html>
<html>
<head>
    <link href="global.css" type="text/css" rel="stylesheet"/>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Muli:200,300,400,600,700" rel="stylesheet">
    <script src="https://use.fontawesome.com/8aa4ff900d.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<body style="background-color: #f5f4f2; font-family: Muli, sans-serif;">

<div class="container">


    <div class="row top"> <!--TOP-->
        <div class="col-sm-9">
            <p class="lets_code"
               style="margin-top: 0; padding: 27px; width: 100%; font-size: 43px; text-transform: uppercase;">Global
                posts
            </p>
        </div>

        <div class="top_form" style="margin-left: 80px">
            <form style="position: relative; height: 100%;" method="post" action="html_post.php">
            <span style="display: grid; position: relative; height: 100%;">
            <button name="exit" id="exit">
                Log out
            </button>
                <span id="global">
                    <a href="html_post.php"> My page </a>
                </span>
            </span>
            </form>
        </div>
    </div>
    <!--TOP-->


    <div class="row posts">


        <div id="global_comment_block">
            <!--ПОСТЫ-->
            <?php
            $post_select = "SELECT content, date, post_id FROM post WHERE checked = 'true' order by date DESC "; //GLOBAL POSTS AND THERE INF
            $result = mysqli_query($connection, $post_select);

            while ($row = mysqli_fetch_array($result)) {
                $post_id = $row['post_id']; //POST ID FOR USER NAME
                ?>


                <?php
                /*ИМЯ ПОЛЬЗЕВАТЕЛЯ ПО ID*/

                $global_id = $GLOBALS["post_id"];
                $name_select = "SELECT blog_users.name FROM blog_users INNER JOIN post ON post.user_id = blog_users.id where post.post_id = '$global_id'";
                $query = mysqli_query($connection, $name_select);

                /*ИМЯ ПОЛЬЗЕВАТЕЛЯ ПО ID*/

                while ($name = mysqli_fetch_array($query)) {
                    ?>


                    <!--ПОСТ NAME-->

                    <span class="name"><?= $name['name'] ?></span>


                    <!--ПОСТ NAME-->

                <?php } ?>

                <!--ПОСТ DATE-->
                <span class="date"><?= $row['date'] ?></span>

                <!--ПОСТ DATE-->


                <!--ПОСТ TEXT-->

                <div class="comment" id="comment"><?= nl2br($row['content']) ?>
                    <p id="comment_fa">
                        <a onclick="comment(<?= $row["post_id"] ?>)" id="show_post_id">
                            <i class="fa fa-comments-o" aria-hidden="true"></i>
                        </a>
                    </p>
                </div>

                <div class="for_c container" id="post_id_<?=$row['post_id']?>"> </div> <!-- post_id_12 -->

            <?php } ?>
            <!--GLOBAL POSTS END-->
        </div>
    </div>

    <script>
        function comment(post_id) {
                $("#post_id_" + post_id).load("list_c.php?post_id=" + post_id);
        }
    </script>

</body>
</html>