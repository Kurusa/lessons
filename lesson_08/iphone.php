<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="iphone.css?2" type="text/css" rel="stylesheet"/>
    <script src="https://use.fontawesome.com/8aa4ff900d.js"></script>
    <link href="css/progress-wizard.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans| Dosis| Muli| Raleway" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <a href="https://ru.icons8.com"> </a>
    <style>
        i.fa.fa-lock {
            color: #FFFFFF;
        }

        input {
            color: #FFFFFF;
        }

    </style>

    <title></title>
</head>
<body>
<div id="inside">


    <div class="icon1 main_icon"> <!-- Верхняя полка -->
        <i class="fa fa-signal icon1" aria-hidden="true"> </i> <!-- Сигнал -->

        <div class="icon1"> Iphone</div>

        <i class="fa fa-wifi icon1" aria-hidden="true"> </i>

        <span style="padding-left: 43px"> 01:59 </span>

        <div class="icon1" id="vid" style="padding-left: 43px"> 100</div>
        <!-- Заряд -->

        <div id="increase" style="display: none" onclick="increaseThisOne()"> <!-- Конец заряда -->
            <div id="for_battery" onclick="increaseThisOne()">
                <p class="vidsotok"> % </p>
            </div>
        </div>

        <span> %</span>

        <span id="battery">
            <i class="fa fa-battery-three-quarters icon1" aria-hidden="true"></i>
        </span>
    </div>


    <div class="first">
        <div id="welcome" style="text-align: center"> Welcome, <br> Dear Friend</div>

        <button class="button" id="login" onclick="myFunction()"> Login <i class="fa fa-user" aria-hidden="true"></i>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </button>


        <button class="button" id="register" style="margin-top: 0" onclick="register()"> Register <i
                class="fa fa-pencil"
                aria-hidden="true"></i>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </button>
    </div>

    <div class="second">
        <div class="container" style="padding: 0!important;">
            <div id="loginpage" class="row" style="background-color: #e6f3f7">
            <span class="back" onclick="mySecondFunction()"> <i class="fa fa-chevron-left"
                                                                aria-hidden="true"></i> </span>
                <span style="font-size: 14px" onclick="mySecondFunction()" class="back"> Back </span>
                <span style="margin-left: 52px" id="deletetop"> Login </span>
                <span style="margin-left: 40px; display: none" id="showtop"> Your Page </span>
            </div>
        </div>
        <div style="text-align: center; display: none" id="top">
            <span style="font-size: 90px; overflow: hidden"> <i class="fa fa-cloud" aria-hidden="true"
                                                                style="color: #0f5f96;"></i> </span>
        </div>

        <div id="inputs" style="text-align: center; display: none; margin-top: 50px; font-size: 18px">

            <div style="display: inline-block">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                <input placeholder="Username" id="forlogin" maxlength="15">
            </div>
            <div style="display: inline-block">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input placeholder="Password" id="forpassword" maxlength="15" style="width: 215px"
                       onkeydown="iconAppear()"
                       onkeyup="iconAppear()" onchange="iconAppear()">

            <span style="background-color: #F08080; cursor: pointer; display: none" id="iconappear"
                  onclick="clearText()">
                    <img class="icon icons8-Удалить" width="64" height="64"
                         src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAABMElEQVR4nO3X3Q2CQBAE4CmFUihlOtNO9UFJjAHkuP053PkS44OwM0uiAiAiIiIiIo2m7AIf5uhAAni837MRry636MDlxajgA13cL8L0FZh5EbjRZc4KpnfwSB0yC2RmpxfJyBymUGRWE8K/WERGF8KvoOdsU4R9UY+Zrgi7wpazQhH9xS1mpCLOL9Bz7lCI9kXOnDM04vhCLcdeCvF7sSPHXBqxveDeZ3+FWF+0xPILovDyC6Lw8kDxC0AU/goQhX8EicJ/g0ThGyGi8K0wUfhhiDi/SM+5QyD6F7CYkYKwK245KwRhX9hjpgvCr6jnbBOEf8GIjFOIuGKRWcMWysgcrkhm9hgFMjtMWcEruNFljg6md2BDl3t0MKMCdxDByy+m6MAdc3YBEREREZGLeQLrIaMim7A1pwAAAABJRU5ErkJggg==">
            </span>
            </div>
        </div>

        <div id="button" onclick="testEnter()"> Log in</div>
    </div>

    <div class="third">
        <div id="main">

            <div class="divforimg">

                <div class="circle"></div>
                <img class="user" src=""/>

                <p style="color: #FFFFFF; padding-top: 12px" class="name"> Кишка </p>

            </div>

            <div class="pes">
                <p onmouseover="myAgeFunction();"><i class="fa fa-clock-o" aria-hidden="true"></i>
                    Вік</p>

                <div class="age"> 4 роки</div>

                <p onmouseover="myLiveFunction();"><i class="fa fa-address-card-o" aria-hidden="true"></i>
                    Проживає</p>

                <div class="live"> На дивані</div>

                <p onmouseover="myLikeFunction();"><i class="fa fa-binoculars" aria-hidden="true"></i>
                    Уподобаня</p>

                <div class="like"> Лоток</div>

                <p onmouseover="myWishFunction();"><i class="fa fa-deaf" aria-hidden="true"></i>
                    Бажає </p>

                <div class="wish"> Кротів</div>

            </div>
        </div>
    </div>
</div>

<div class="registration_page" style="display: none; font-family: Helvetica Neue, sans-serif;">
    <div class="row " id="almost_registration_page" style="background-color: #63cdf5; color: #FFFFFF">
        <span class="back"> <i class="fa fa-chevron-left" aria-hidden="true" style="color: #FFFFFF"></i> </span>
        <span style="font-size: 14px" class="back" onclick="mySecondFunction()"> Back </span>
        <span style="margin-left: 35px; font-size: 16px" class="registration"> Registration </span>
    </div>

    <div style="position: absolute;top: 10%; color:#5c5e5f;">
        <div class="arrow-block">
            <p id="phrase"></p>

            <p id="question">Под каким ником Вы желаете заходить на страницу?</p>

            <input id="registration_input" placeholder="enter here" maxlength="15">

        </div>
        <div class="arrow-down"></div>
    </div>



    <button id="continue" type="submit" onclick="event.preventDefault(); submit_function()">
        Continue
        <i class="fa fa-angle-right" aria-hidden="true" style="display: inline-block"></i>
    </button>
</div>



<script>

function register() {
    $("#welcome").css('display', 'none');
    $(".registration_page").show();
    $("#login").css('display', 'none');
    $("#register").css('display', 'none');
    phrase_massive();
}

function myFunction() {
    document.getElementById('inside').style.backgroundImage = "url(/lesson_08/img2/intro5.png)";
}

function mySecondFunction() {
    $('#inside').css('background', 'linear-gradient(135deg, #b5bdc0, #ceae95)');
    $(".registration_page").css('display', 'none');
}

$("#login").click(function () {
    $(".button").css('display', 'none');
    $("#welcome").css('display', 'none');
    /*$(".nya").css('display', 'none');*/
    $("#loginpage").show();
    $("#top").show();
    $("#inputs").show();
    $("#loginheader").show();
    $("#button").show();
});

$(".back").click(function () {
    $(".button").show();
    $("#welcome").show();
    $("#loginpage").css('display', 'none');
    $("#inputs").css('display', 'none');
    $("#button").css('display', 'none');
    $("#top").css('display', 'none');
    $("#loginheader").css('display', 'none');
    $("#main").css('display', 'none');
});

$(window).load(function () {
    vid = document.getElementById("vid").innerHTML;
    letsGo();
});

function letsGo() {
    if (vid == 0) {
        $("#increase").show();
        return increaseThisOne();
    } else if (vid <= 50) {
        document.getElementById('battery').innerHTML = '<i class="fa fa-battery-half" aria-hidden="true"></i>';
    } else if (vid <= 25) {
        document.getElementById('battery').innerHTML = '<i class="fa fa-battery-quarter" aria-hidden="true"></i>';
    }
    vid--;
    document.getElementById("vid").innerHTML = vid;
    setTimeout(letsGo, 10000);
}

function increaseThisOne() {
    document.getElementById('vid').innerHTML = vid;
    vid = vid + 10;
    if (vid == 100) {
        $("#increase").css('display', 'none');
        return letsGo();
    }
}

function iconAppear() {
    $("#iconappear:hidden").show("fast");
}

function clearText() {
    document.getElementById('forpassword').value = "";
}

function myAgeFunction() {
    if ($(".age").is(":hidden")) {
        $(".age").slideDown("slow");
    }
    else {
        $(".age").hide();
    }
}
function myLiveFunction() {
    if ($(".live").is(":hidden")) {
        $(".live").slideDown("slow");
    }
    else {
        $(".live").hide();
    }
}
function myLikeFunction() {
    if ($(".like").is(":hidden")) {
        $(".like").slideDown("slow");
    }
    else {
        $(".like").hide();
    }
}
function myWishFunction() {
    if ($(".wish").is(":hidden")) {
        $(".wish").slideDown("slow");
    }
    else {
        $(".wish").hide();
    }
}

var users = [
    {
        "name": "Kurusa",
        "pass": "Kurusa123",
        "age": '17',
        "live": "На балконі",
        "like": 'Солодка вата!',
        "wish": "Кур-кур",
        "img": "http://pm1.narvii.com/6572/61704f588bd6a632cbd0e1088c4fb6ac935b1c39_128.jpg"
    },
    {
        "name": "Zhecky",
        "pass": "Zhecky123",
        "age": '19',
        "live": "Нівана",
        "like": 'Ампери',
        "wish": "Кріс",
        "img": "https://i.ytimg.com/vi/kR24k7tLVxQ/maxresdefault_live.jpg"
    },
    {
        "name": "Святий",
        "pass": "Святий123",
        "age": '27',
        "live": "У Рейн",
        "like": 'Вино',
        "wish": 'Мамки :з',
        "img": "http://www.shroud.com.ua/wp-content/uploads/2016/11/Ikona-iz-zobrazhennyam-Svyatogo-apostola-Petra.jpg"
    },
    {
        "name": "Кишка",
        "pass": "Кишка123",
        "age": '4',
        "live": "На дивані",
        "like": 'Лоток',
        "wish": 'Кротів',
        "img": "https://avatanplus.com/files/resources/mid/57cbea606e601156f48b88c4.png"
    },
    {
        "name": "Rein",
        "pass": "Rein123",
        "age": '18',
        "live": "На сцені",
        "like": 'Вино',
        "wish": 'Петра',
        "img": "https://s.tcdn.co/9b9/0bc/9b90bc51-73a3-3422-9ddb-a4922484a78b/192/10.png"
    }
];

document.querySelector('button').addEventListener('click', testEnter);

function testEnter() {
    var inUsers = false;
    var login = document.getElementById('forlogin').value;
    var second = document.getElementById('forpassword').value;

    for (var a = 0; a < users.length; a++) {
        if (login == users[a].name && second == users[a].pass) {
            inUsers = true;
            document.getElementsByClassName('age')[0].innerHTML = users[a].age;
            document.getElementsByClassName('live')[0].innerHTML = users[a].live;
            document.getElementsByClassName('like')[0].innerHTML = users[a].like;
            document.getElementsByClassName('wish')[0].innerHTML = users[a].wish;
            document.getElementsByClassName('name')[0].innerHTML = users[a].name;
            document.getElementsByClassName('user')[0].src = users[a].img;
            $("#main").show();
            $("#showtop").show();
            $("#deletetop").css('display', 'none');
            $(".fa-cloud").css('display', 'none');
            $("#inputs").css('display', 'none');
            $("#button").css('display', 'none');
        }
    }
}

var phrases = [
    "go for it",
    "why not?",
    "it's worth a shot",
    "what are you waiting for?",
    "what do you have to lose?",
    "you might as well",
    "just do it",
    "there you go!",
    "keep up the good work",
    "keep it up",
    "good job",
    "we are so proud of you!",
    "hang in there",
    "the sky isn't the limit",
    "believe in yourself",
    "do the impossible",
    "reach for the stars",
    "follow your dreams",
    "it's your call",
    "it's totally up to you",
    "come on! You can do it!",
    "Never give up",
    "Stay strong.",
    "Keep fighting!",
    "Keep pushing",
    "Don't give up"
];

var i = -1;
function phrase_massive() {
    document.getElementById('phrase').innerHTML = "";
    if (++i < phrases.length) { //++i увеличивает i на еденицу и возвращает новое значение i.
        //если i было -1, то после этого оно будет равным 0
        // phrases.length - к-во элементов в массиве. нумерация массива с 0, потому переменной присвоили -1
        // ( ++i < phrases.length ) сравниваем переменную с длиной массива, увеличивая её на 1


        document.getElementById('phrase').innerHTML = phrases[i]; // записываем в спан i, увеличиную на 1, которая является индексом
        setTimeout(phrase_massive, 15000);
    }
}

var input_length = document.getElementById('registration_input').value.length;
var question = document.getElementById('question').innerHTML;
function submit_function() {

    if (question == questions[0] && document.getElementById('registration_input').value.length >= 4) {
        next_question();

        if (question == questions[1] && document.getElementById('registration_input').value.length >= 7) {
            next_question();

            if (question == questions[2] && document.getElementById('registration_input').value.length <= 2) {
                next_question();

                if (question == questions[3] && document.getElementById('registration_input').value.length >= 3) {
                    next_question();

                    if (question == questions[4] && document.getElementById('registration_input').value.length >= 3) {
                        next_question();

                        if (question == questions[5] && document.getElementById('registration_input').value.length >= 3) {
                            next_question();
                        } else {
                            console.log('false5');
                        }

                    } else {
                        console.log('false5');
                    }
                } else {
                    console.log('false3');
                }

            } else {
                console.log('false2');
            }

        } else {
            console.log('false1');
        }

    } else {
        console.log('false0');
    }
}


var questions = [
    "Под каким ником Вы желаете заходить на страницу?",
    "И пароль, пожалуйста.",
    "Ваш возраст?",
    "Где живете? (пример: балкон)",
    "Что вам нравится? (пример: сладкая вата)",
    "Чего вы желаете? (пример: мамки)"
];


var a = 0;

function next_question() {
    if (++a < questions.length) {
        document.getElementById('question').innerHTML = questions[a];
        document.getElementById('registration_input').value = "";
    }
}

</script>

</body>
</html>