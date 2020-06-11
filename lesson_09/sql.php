<?php
header( 'Content-Type: text/html; charset=utf-8' );

$connection = mysqli_connect("localhost", "kurusa_test", "4HtyhPCfuy");

mysqli_set_charset($connection, "utf8");

mysqli_select_db($connection, "kurusa_test");


$sql = "SELECT * FROM _kurusa"; //выбираем все данные с таблички

$result = mysqli_query($connection, $sql); //присваиваем переменной результат выполнения mysqli_query - набор данных с таблицы

        echo "<table>";//табличка

        echo "<tr>";//ряд

        echo "</tr>";// ряд

        while($row = mysqli_fetch_array($result)) {
            //каждый раз, когда вызывается mysqli_fetch_array,
                // с массива, в котором хранятся данные (сначала они сохранённые в $result), по очереди выбирается одна строка
                echo "<tr>";//ряд

                echo "<td>". "<a href='https://vk.com/id/".$row['id']."'> ".$row['name']." </a>". "</td>";//по очереди берём с таблицы айди

                echo "<td>". "<img src='".$row['photo']."'>". "</td>";// и имена

                echo "</tr>";//
        }
        echo "</table>";//отображаем табицу



// выбрать данные селектом, отобразить
// чтобы отобразить нужен массив
// mysqli_fetch_array делает массив данных
// данные надо где-то держать
//КУРВААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААААФВАГСАИФГШУВЦТОЛІДБЖЧЄДВАРЛШЙЗХ ЩЛАРЛВДІЩЗЖЦДВЩЛАШОПИТР
// в переменной, ладно
// пройтись по массиву вайлом, так проще и меньше кода


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/lesson_11/style.css">

</head>
<body>

    <table style="color: #1a8fb7">
    </table>

</body>
</html>