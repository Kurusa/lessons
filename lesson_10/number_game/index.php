<?php
if (isset($_GET['sum_result'])) {

    $number = $_GET["number"];

    $summa = 0;

    for ($i = 0; $i <= strlen($number); $i++) {
        $summa += $number[$i];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="number.css" type="text/css" rel="stylesheet"/>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Muli:200,300,400,600,700" rel="stylesheet">
</head>
<body style="font-family: Muli, sans-serif">

<form action="index.php" method="get" name="sum">

    <div class="enter"> Введите число(сума его чисел)</div>

    <input name="number">

    <button type="submit" name="sum_result"> Submit</button>

</form>

<div class="result">
    <?php
    echo $summa;
    ?>
</div>

</body>
