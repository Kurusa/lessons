<!DOCTYPE html>
<html>
<head>
    <link href="light.css" type="text/css" rel="stylesheet"/>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Muli:200,300,400,600,700" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
</head>
<body style="font-family: Muli, sans-serif">


<div class="main_block">

    <div class="red active item" data-color="red"></div>
    <div class="yellow item" data-color="yellow"></div>
    <div class="green item" data-color="green"></div>

</div>

<script>
</script>


<script>
    function change() {

        var duration = { // сколько времени какой цвет должен светиться
            red: 2,// в конце этот массив используется к функции setTimeout
            yellow: 1,
            green: 3
        };

        var container = $(".main_block .active"); // берем элемент из блока main-block с классом active (он там один)

        console.log(container.data('color'));

        setTimeout(function () {

            container.removeClass('active'); // у выше выбраного элемента забираем класс active

            var next = container.next();

            if (next.length == 0) {
                next = $(".main_block .red");
            }

            next.addClass('active');

            change();
        }, duration[container.data('color')] * 1000); //из массива duration берем значение ключа, который равен data-color элемента с классом active
    }

    change();

</script>
</body>

