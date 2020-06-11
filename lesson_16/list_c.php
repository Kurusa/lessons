<div class="row">

    <!--FORM FOR COMMENTS-->
    <form class="col-sm-2 form_add_c" method="post">
        <div class="add_c">
            <input type="hidden" value="" name="post_id">

            <textarea class="write_c" placeholder="Write you comment here"
                      name="text_c"></textarea>

            <button class="submit_c" type="button" name="send_c" onclick="send(<?=$_GET['post_id']?>)"> Send</button>

        </div>
    </form>

    <!--FORM FOR COMMENTS-->


    <?php
    session_start();


    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include("connection.php");

    $post_id = $_GET['post_id'];

    $select_c = "select content, user_name, date FROM comment WHERE id_post = '$post_id'";

    $result = mysqli_query($connection, $select_c);

    while ($row = mysqli_fetch_array($result)) {
    ?>
    <div class="col-sm-1"></div>

    <div class="col-sm-8 comments">

        <div class="name_date">
            <span class="name"> <?= $row['user_name'] ?> </span> commented on
            <span><?= $row['date'] ?></span>

            <form action="html_post.php" method="post">
                <button type="submit" name="like"> LIKE ME!</button>
            </form>


        </div>

        <div class="text"> <?= $row['content'] ?> </div>

    </div>

<?php } ?>


    <script>

        function send(post_id) {

                $.ajax({
                    url: "all_functions.php",
                    type: "POST",
                    data: {
                        post_id: post_id,
                        text_c: $(".write_c").val(),
                        action: "add_c"
                    },
                    success: function () {
                        $("#post_id_" + post_id).load("list_c.php?post_id=" + post_id);
                        document.getElementsByClassName('write_c')[0].value = "";
                    }
                })

        }
    </script>


</div>