<?php
session_start();

include('connection.php');

mysqli_query($connection, "SET NAMES utf8");

$id = $_SESSION['id'];
$post_select = "SELECT post.content, post.date, post.post_id FROM post INNER JOIN blog_users ON post.user_id = blog_users.id where blog_users.id = '$id' ORDER BY date DESC ";
$result = mysqli_query($connection, $post_select);
while ($row = mysqli_fetch_array($result)) {

    $with_html_chars = htmlspecialchars($row['content']); /*&lt;a&gt; &lt;strong&gt; vk.com &lt;/strong&gt;&lt;/a&gt; */

    $nl2br = nl2br($row['content']);

    ?>

    <span style="font-size: 17px; font-weight: 200; padding-left: 25px"><?= $row['date'] ?></span>

    <div class="hrefs">
        <a id="edit" style="padding-right: 10px" onclick="changePost(<?= $row["post_id"] ?>)">
            <i class="fa fa-pencil" aria-hidden="true"></i> </a>


        <a id="delete" onclick="deletePost(<?= $row["post_id"] ?>)"> <i
                class="fa fa-times" aria-hidden="true"></i></a>
    </div>

    <div class="comment" id="<?=$row["post_id"]?>"
         style="margin-top: 5px; margin-bottom: 35px"><?= $nl2br ?>
    </div>

<?php } ?>


<div class="modal" tabindex="-1" role="dialog" id="myModal">

</div>
<script>

    function changePost(post_id) {
        $("#myModal").load("change_modal.php?post_id=" + post_id);
    }

    function deletePost(post_id) {
        $.ajax({
            url: "all_functions.php",
            type: "GET",
            data: {
                post_id: post_id,
                action: "delete"
            },
            success: function () {
                $('#comment_block').load('list_post.php');
            }
        })
    }

</script>





