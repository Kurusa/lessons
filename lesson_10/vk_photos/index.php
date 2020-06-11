<!DOCTYPE html>
<html>
<head>
    <link href="style.css" type="text/css" rel="stylesheet"/>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Muli:200,300,400,600,700" rel="stylesheet">
    <script src="https://use.fontawesome.com/8aa4ff900d.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
<?php
//sergo nyash c:
include_once("class/User.php");
include_once("class/Vk.api.php");

session_start();

$User = new User($_SESSION["token"], $_SESSION["user_id"]);
$VkApi = new Vk();
ini_set('display_errors', 1);

$app_id = "6374418"; // ID приложения

$app_key = "M77Ewzz1ecbnkaDEzOOx"; // Защищённый ключ

$redirect_uri = "http://kurusa.zhecky.net/lesson_10/vk_photos/index.php"; //Адрес сайта

$scope = "photos"; //к чему получить доступ

//код для получения ключа доступа, access-token
if (!empty($_GET["code"])) {
    //получаем access token

    $result = $VkApi->auth("access_token", [
        'client_id' => $app_id,
        'client_secret' => $app_key,
        "redirect_uri" => $redirect_uri,
        "code" => $_GET["code"]
    ]);

    $_SESSION["token"] = $result["access_token"];
    $_SESSION["user_id"] = $result["user_id"];

    $User->setToken($result["access_token"]);
    $User->setUID($result["user_id"]);
}

if (empty($User->getToken())) {

    //окно аутентификаци
    echo "<a href='https://oauth.vk.com/authorize?client_id=$app_id&display=page&redirect_uri=$redirect_uri&scope=$scope&response_type=code&=5.73'> Auth </a>";

} else {

    echo " <form action=\"index.php\" name=\"logout\" method=\"get\"><button type=\"submit\" name=\"logout\">Logout</button> </form>";

    $result = $VkApi->api("photos.getAlbums", [
        'owner_id' => $User->getUID(),
    ]);

    foreach ($result["response"] as $photos_info) {

        $result2 = $VkApi->api("photos.get", [
            "access_token" => $User->token,
            'owner_id' => $User->getUID(),
            'album_id' => $photos_info["album_id"]
        ]);

        foreach ($result2["response"] as $photos) {
            ?>

            <img src="<?= $photos['src'] ?>">

            <?php
        }
    }
}

if (isset($_GET["logout"])) {
    unset($_SESSION["token"]);
    unset($_SESSION["user_id"]);
}
?>
</body>