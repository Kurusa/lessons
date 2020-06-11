<?php

session_start();

include ('ENTER.php');

$connection = mysqli_connect("localhost", NAME_YOUR_DATABASE_RIGHT, WRITE_YOUR_DATABASE_PASSWORD_RIGHT); /**/
mysqli_select_db($connection, NAME_YOUR_DATABASE_RIGHT);

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (is_string($_POST['name']) && strlen($_POST['name']) >= 3) { /*проверка имени на длинну и не написали ли лишнего*/
        $email = $_POST['email']; /*переменная с имейлом*/
        $name = $_POST['name']; /*переменная с именем*/
        if (strlen($_POST['email']) >= 12 && filter_var($email, FILTER_VALIDATE_EMAIL)) {/*проверка имейла на длинну и прочие знаки*/
            if ($_POST['sex'] > 0) {/*выбрали ли кто придет*/
                $sex = $_POST['sex']; /**/
                $date = date("Y-m-d H:i:s");
                $check_name = "insert into party(name, email, sex, date) values('$name', '$email', '$sex', '$date')";/*записываем имя, имейл и кто придет в базу данных*/
                $result = mysqli_query($connection, $check_name);/*выполняем запрос*/
                header("Location: http:///*твій url (наприклад, vk.com/)*//my-flusk/ImageMaker.class.class.php#contact");/*перенаправляем на блок с регистрацией*/
            } else {
                header("Location: http:// /my-flusk/ImageMaker.class.phpss.php#contact");/*перенаправляем на блок с регистрацией*/
            }
        } else {
            header("Location: http:// /my-flusk/ImageMaker.class.phpss.php#contact");/*перенаправляем на блок с регистрацией*/
        }
    } else {
        header("Location: http:// /my-flusk/ImageMaker.class.class.php#contact");/*перенаправляем на блок с регистрацией*/
    }
}
