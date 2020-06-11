<?php
$connection = mysqli_connect("localhost", "kurusa_test", "4HtyhPCfuy");
mysqli_select_db($connection, "kurusa_test");

include("../vk_photos/class/Vk.api.php");
include("access_token.php");
$VkApi = new Vk();
ini_set('display_errors', 1);

$post = $VkApi->api("wall.get", [
    "access_token" => ACCESS_TOKEN,
    "owner_id" => "-160719294",
    "count" => 1
]);
foreach ($post["response"]["items"] as $item) {

    $post_date = date("Y-m-d\ H:i:s", $item["date"]);
    $time_difference = time() - strtotime($post_date);
    $minutes_diff = $time_difference / 60;

    if ($minutes_diff >= 0) {
        //вибрати останній пост з таблиці, в якого queue = true

        $select_post = "SELECT `id`, `text`, `url` FROM `queue` WHERE posted = 0 LIMIT 1";

        $result = mysqli_query($connection, $select_post);

        while ($row = mysqli_fetch_array($result)) {

            $id = $row["id"];
            if (!empty($row["text"]) || !empty($row["url"])) {

                if (strlen($row["text"]) > 2) {

                    $VkApi->api("wall.post", [
                        "access_token" => ACCESS_TOKEN,
                        "owner_id" => "-160719294",
                        "from_group" => 1,
                        "message" => $row["text"],
                    ]);

                    $update = "UPDATE queue SET posted = 1 WHERE id = $id";

                    mysqli_query($connection, $update);
                } else {
                    echo "Too short text";
                }


                if (preg_match("~^https?://\S+(?:jpg|jpeg|png)$~", $row["url"])) {

                    $update = "UPDATE queue SET posted = 1 WHERE id = $id";

                    mysqli_query($connection, $update);

                    //-----------------------------ЗАВАНТАЖУЮ СОБІ-----------------------
                    $ch = curl_init($row["url"]);
                    $fp = fopen('../vk_post/photo/image.jpg', 'wb');
                    curl_setopt($ch, CURLOPT_FILE, $fp);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_exec($ch);
                    curl_close($ch);
                    fclose($fp);
                    //--------------------------------------------------------------------

                    //------------------------ОТРИМУЮ СЕРВЕР------------------------------
                    $get_server_query = $VkApi->api("photos.getWallUploadServer", [
                        "access_token" => ACCESS_TOKEN,
                        "group_id" => GROUP_ID
                    ]);

                    $server = $get_server_query["response"]["upload_url"];
                    //------------------------------------------------------------------


                    //----------------------ЗАВАНТАЖУЮ НА СЕРВЕР ВК------------------------

                    function getPhotoInfo($server)
                    {
                        $photo = curl_file_create(realpath('../vk_post/photo/image.jpg'));
                        $post = array('photo' => $photo);
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $server);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                        $result = json_decode(curl_exec($ch), true);
                        curl_close($ch);
                        return $result;
                    }

                    $param = getPhotoInfo($server);
                    //------------------------------------------------------------------


                    //----------------------ОТРИМУЮ ID ФОТО-----------------------------
                    $get_photo_id = $VkApi->api("photos.saveWallPhoto", [
                        "access_token" => ACCESS_TOKEN,
                        "group_id" => GROUP_ID,
                        "photo" => $param["photo"],
                        "server" => $param["server"],
                        "hash" => $param["hash"]
                    ]);
                    //------------------------------------------------------------------

                    foreach ($get_photo_id["response"] as $id) {
//------------------------------------------------------------------//
                        $VkApi->api("wall.post", [
                            "access_token" => ACCESS_TOKEN,
                            "owner_id" => "-160719294",
                            "from_group" => 1,
                            "attachments" => "photo156242304_" . $id["id"] . ""
                        ]);
//------------------------------------------------------------------//
                    }
                }

            }
        }
    }
}
