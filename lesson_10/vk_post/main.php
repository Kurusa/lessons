<?php
$connection = mysqli_connect("localhost", "kurusa_test", "4HtyhPCfuy");
mysqli_select_db($connection, "kurusa_test");
mysqli_query($connection, "SET NAMES utf8");
include("../vk_photos/class/Vk.api.php");
include("access_token.php");
$VkApi = new Vk();
ini_set('display_errors', 1);

if ($_POST["action"] == "add_post") {
    if (!empty($_POST["src"]) || !empty($_POST["text"])) {

        $text = htmlspecialchars($_POST["text"]);
        $url = $_POST["src"];
        if (isset($_POST['checked']) && $_POST['checked'] == "yes") {

            $insert = "INSERT INTO queue(`text`, `url`, `posted`) VALUES ('{$text}', '{$url}', false)";

            mysqli_query($connection, $insert);
        } else {
            if (strlen($text) > 2) {

                $VkApi->api("wall.post", [
                    "access_token" => ACCESS_TOKEN,
                    "owner_id" => "-160719294",
                    "from_group" => 1,
                    "message" => $text,
                ]);


            } else {
                echo "Too short text";
            }


            if (preg_match("~^https?://\S+(?:jpg|jpeg|png)$~", $_POST["src"])) {

                //-----------------------------ЗАВАНТАЖУЮ СОБІ-----------------------
                $ch = curl_init($_POST["src"]);
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

                foreach ($get_photo_id["response"] as $item) {
//------------------------------------------------------------------//
                    $VkApi->api("wall.post", [
                        "access_token" => ACCESS_TOKEN,
                        "owner_id" => "-160719294",
                        "from_group" => 1,
                        "attachments" => "photo156242304_" . $item["id"] . ""
                    ]);
//------------------------------------------------------------------//
                }

            } else {
                echo "no";
            }
        }
    } else {
        echo "empty";
    }
} elseif ($_POST["action"] == "delete") {

    $VkApi->api("wall.delete", [
        "access_token" => ACCESS_TOKEN,
        "owner_id" => "-160719294",
        "post_id" => $_POST["post_id"]
    ]);

}