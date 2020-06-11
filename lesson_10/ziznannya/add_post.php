<?php
include("common_var.php");
$select_max_value = "SELECT MAX(post_id) FROM vk_post";

//ОТРИМУЄМО ПОСТИ
$post = $VkApi->api("wall.get", [
    "access_token" => ACCESS_TOKEN,
    "owner_id" => GROUP_ID,
    "count" => 15
]);

$get_max_value = mysqli_query($connection, $select_max_value);
$row = mysqli_fetch_array($get_max_value);
$max_post_id = $row["MAX(post_id)"];
//---------------

foreach ($post["response"]["items"] as $item) {
    //І ІНФОРМАЦІЮ ПРО НИХ
    $post_id = $item["id"];
    $date = date("Y-m-d\ H:i:s", $item["date"]);
    $admin = $item["created_by"];
    //---------------------

    if ($post_id > $max_post_id) {
        $insert = "INSERT INTO vk_post(post_id, date, admin) VALUES ('$post_id', '$date', '$admin')";
        mysqli_query($connection, $insert);
        } else {
        break;
    }
}
