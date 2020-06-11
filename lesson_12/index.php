<?php


// проверяется, нажата ли кнопка
// без этого условия весь код в этом иф-е выполнится сразу при загрузке страници
// он влияет на то, когда  скрипт выполниться
// 1.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// весь код, написанный до иф-а, сохраняет к-во секунд, прошедшее от 70-го года и до этого момента

// переменной $file присваивается значение "last_kur_kur_time.txt"
// "last_kur_kur_time.txt" - файл, куда запишется к-во секунд, прошедшее от 70-го года до этого момента
// без этого нам будет некуда записывать данные последнего кур-кура
    $file = "last_kur_kur_time.txt";
    $second_file = "number.txt";

// функция file_put_contents возвращает к-во записанных в файле байт, поэтому нас нужно использовать ф-цию file_get_contents
// она читает файл и возвращает прочитанные данные, или содержимое, файла в типе string
// мы СОХРАНЯЕМ эти данные в переменной, чтобы они не исчезли и их можно было использовать
// без этой функции у нас бы не было текстового представления файла
// и мы не могли бы его использовать в своих целях
// параметр "last_kur_kur_time.txt" - имя файла, который надо прочитать
// 2.
    $last_kur_kur_time_string = file_get_contents("last_kur_kur_time.txt");

// проверяем, прошел ли час от последнего кур-кура
// если разница текущего времени и времени последнего кур-кура равна или больша одному часу
// 3.

    if (time() - (intval($last_kur_kur_time_string)) >= (60 * 60)) {
        echo "Kur-kur" . "<br />";
// к-во секунд, прошедших от 70-го года до последнего кур-кура изменяем на текущие
// 4.
        $last_kur_kur_time = file_put_contents($file, time());


        $number = (intval(file_get_contents($second_file)));
//увеличиваем число из файла
        $number++;
//записываем в файл
        $amount_of_kur_kur = file_put_contents($second_file, $number);
// читаем файл в стринг
        $amount_of_kur_kur_string = file_get_contents("number.txt");

// открываем файл в переменную
        $date = file_get_contents($second_file);
        $date = date('d.m.y');

// 5.
    } else {
        $no = "Низя";
    }





// А ЦЕ БЛЯТЬ ЇБУЧА ДУЖЕЧКА! ЩО БИ Я БЛЯТЬ РОБИВ БЕЗ ТАКОЇ ВАЖЛИВОЇ ІНФОРМАЦІЇ БЛЯТЬ
}

?>


<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css?3">
    <link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
            integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="jumbotron"> Кур-кур заборонено</div>

<form action="index.php" method="POST">
    <button class="request"> Зареквестити кур-кур</button>
</form>

<div class="container">
    <div class="row">

        <div class="col-4"> </div>
        <div class="col-4">
            <div id="amount"> <?php echo $amount_of_kur_kur_string; ?> </div>
            <div id="date"> <?php echo $date; ?> </div>
        </div>
            <div class="col-4"> </div>
    </div>
    </div>

<div class="no">
<?php
echo $no;

?>

</div>

</body>
