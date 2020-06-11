<?php
include("../vk_photos/class/Vk.api.php");
include("access_token.php");
session_start();
ini_set('display_errors', 1);

$VkApi = new Vk();

$post = $VkApi->api("wall.get", [
    "access_token" => ACCESS_TOKEN,
    "owner_id" => "-160719294",
]);

foreach ($post["response"]["items"] as $item) {
    ?>
    <hr style="margin-top: 20px;margin-bottom: 20px;border-color: rgba(138, 84, 145, 0.32);">
    <span class="date"
          style="color: #A056AA;font-size: 14px;"> <?= date("Y-m-d\ H:i:s", $item["date"]); ?></span>
    <p class="topic"> <?= $item["text"] ?> </p>
    <div>
        <i class="fa fa-comment"></i> <span class="other"> <?= $item["comments"]["count"] ?> </span>
        <i class="fa fa-thumbs-o-up"></i> <span class="other"> <?= $item["likes"]["count"] ?> </span>
        <i class="fa fa-eye"></i> <span class="other"> <?= $item["views"]["count"] ?> </span>

        <i class="fa fa-trash" onclick="deletePost(<?= $item["id"] ?>)" style="font-size: 18px;margin-left: 10px;"></i>

    </div>
    <?php
    if (isset($item["attachments"])) {
        foreach ($item["attachments"] as $item2) {
            ?>
            <img src='<?= $item2["photo"]["photo_130"] ?>'>
            <?php
        }
    }
}
?>

<script>
    function deletePost(post_id) {
        $.ajax({
            url: "main.php",
            type: "POST",
            data: {
                post_id: post_id,
                action: "delete"
            },
            success: function () {
                div.parentNode.removeChild(div);
                $('#post_block').load('load_post.php');
            }
        })
    }
</script>