<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


$connection = mysqli_connect("localhost", "kurusa_test", "4HtyhPCfuy");
mysqli_select_db($connection, "kurusa_test");
echo mysqli_error($connection);


if (!mysqli_set_charset($connection, "utf8")) {
    printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($connection));
    exit();
}

if (isset($_POST['exit'])) {
    session_destroy();
    header("Location:http://kurusa.zhecky.net/lesson_16/html_log_in.php");
}












