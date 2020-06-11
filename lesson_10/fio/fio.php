<?php
if (isset($_GET['submit'])) {

    $f = $_GET["f"];
    $i = mb_strtoupper($_GET["i"]);
    $o = mb_strtoupper($_GET["o"]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="/lesson_10/number_game/number.css" type="text/css" rel="stylesheet"/>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Muli:200,300,400,600,700" rel="stylesheet">
</head>
<body style="font-family: Muli, sans-serif">

<form action="fio.php" method="get">

    <div class="enter"> Введите свои ФИО</div>

    <input name="f" placeholder="Фамилия">

    <input name="i" placeholder="Имя">

    <input name="o" placeholder="Отчество">

    <button type="submit" name="submit"> Submit</button>

</form>


<div class="result">
    <?= $f . ' ' . mb_substr($i, 0, 1, "utf-8") . ' ' . mb_substr($o, 0, 1, "utf-8");
    ?>
</div>


</body>