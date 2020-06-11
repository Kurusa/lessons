<?php
$now_hours = date('G');
if ($now_hours == 0) {
    $time = "zero";
} elseif ($now_hours == 1) {
    $time = "first";
} elseif ($now_hours == 2) {
    $time = "second";
} elseif ($now_hours == 3) {
    $time = "third";
} elseif ($now_hours == 4) {
    $time = "fourth";
} elseif ($now_hours == 5) {
    $time = "five";
} elseif ($now_hours == 6) {
    $time = "six";
} elseif ($now_hours == 7) {
    $time = "seven";
} elseif ($now_hours == 8) {
    $time = "eight";
} elseif ($now_hours == 9) {
    $time = "nine";
} elseif ($now_hours == 10) {
    $time = "ten";
} elseif ($now_hours == 11) {
    $time = "eleven";
} elseif ($now_hours == 12) {
    $time = "twelve";
} elseif ($now_hours == 13) {
    $time = "thirteen";
} elseif ($now_hours == 14) {
    $time = "fourteen";
} elseif ($now_hours == 15) {
    $time = "fifteen";
} elseif ($now_hours == 16) {
    $time = "sixteen";
} elseif ($now_hours == 17) {
    $time = "seventeen";
} elseif ($now_hours == 18) {
    $time = "eighteen";
} elseif ($now_hours == 19) {
    $time = "nineteen";
} elseif ($now_hours == 20) {
    $time = "twenty";
} elseif ($now_hours == 21) {
    $time = "twenty-one";
} elseif ($now_hours == 22) {
    $time = "twenty-two";
} elseif ($now_hours == 23) {
    $time = "twenty-three";
} elseif ($now_hours == 24) {
    $time = "twenty-four";
}

session_start();

include('connection.php');

if (!mysqli_set_charset($connection, "utf8")) {
    printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($connection));
    exit();
}


if (isset($_POST['hidden_login'])) {

    $login_name = addslashes(strip_tags($_POST['login_name'])); /*берем введенное имя*/
    $check_name = "select count(*) FROM blog_users WHERE name = '$login_name'";/*проверяем к-во таких имен в таблице*/
    $result = mysqli_query($connection, $check_name);/*выполняем запрос*/
    $row = mysqli_fetch_row($result);/*в массив его*/

    if ($row[0] > 0) {/*если такое имя есть*/

        $login_pass = $_POST['login_pass'];/*в переменную его*/

        $hash = "SELECT password FROM blog_users WHERE name = '$login_name'";/*ищем пароль такого юзера*/

        $pass_query = mysqli_query($connection, $hash);/*выполняем запрос*/

        $pass_result =  mysqli_fetch_assoc($pass_query);/*в массив его*/

        if (password_verify($login_pass, $pass_result["password"])) {/*если введенный пароль соответствует тому, что ввели*/

            /*надо вытянуть посты этого юзера*/

            $_SESSION['name'] = $login_name;

            $select_id = "select id from blog_users WHERE name = '$login_name'";
            $id_query = mysqli_query($connection, $select_id);/*выполняем запрос*/
            $id_result = mysqli_fetch_assoc($id_query);/*в массив его*/

            $_SESSION['id'] = $id_result['id'];

            header("Location: http://kurusa.zhecky.net/lesson_16/html_post.php");/*перенаправляем на страницу*/

            header('Content-type: text/html; charset=utf-8');
            exit(0);/**/
        } else {
        }
    }
}




/*reg_name reg_pass*/
if (isset($_POST['hidden_registration'])) {
    $regex = "/^[a-zа-яё0-9_]{3,15}$/iu";
    if (preg_match($regex, $_POST['reg_name']) and preg_match($regex, $_POST['reg_pass'])) {

        $hash = password_hash($_POST['reg_pass'], PASSWORD_DEFAULT);
        /*хеш пароля*/

        $name = addslashes(strip_tags($_POST['reg_name']));
        /*очистить от всякой нечисти*/

        $name_count = "select count(*) FROM blog_users WHERE name = '$name'";
        /*проверяем, если ли в таблице такое имя*/

        $result = mysqli_query($connection, $name_count);
        /*исполняем запрос*/

        $row = mysqli_fetch_row($result);
        /*в массив*/

        if ($row[0] > 0) {
        } else {

            $update = "INSERT INTO blog_users(name, password) VALUES ('$name', '$hash')";

            mysqli_query($connection, $update);//выполняем запрос

            $_SESSION['name'] = $name;

            $select_id = "select id from blog_users WHERE name = '$name'";
            $id_query = mysqli_query($connection, $select_id);/*выполняем запрос*/
            $id_result = mysqli_fetch_assoc($id_query);/*в массив его*/
            $_SESSION['id'] = $id_result['id'];

            header("Location: http://kurusa.zhecky.net/lesson_16/html_post.php");
            header('Content-type: text/html; charset=utf-8');
            exit(0);
        }
    }
}














