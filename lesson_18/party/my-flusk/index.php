<?php
include ('script.php');


?>
<!DOCTYPE html>
<!--[if IE 7 ]>
<html class="ie ie7 lte9 lte8 lte7" lang="en-US"><![endif]-->
<!--[if IE 8]>
<html class="ie ie8 lte9 lte8" lang="en-US">    <![endif]-->
<!--[if IE 9]>
<html class="ie ie9 lte9" lang="en-US"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="noIE" lang="en-US">
<!--<![endif]-->
<head>
    <title>Flusk</title>

    <!-- meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no"/>

    <!-- google fonts -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans'>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,bold"/>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Alegreya+Sans:regular,italic,bold,bolditalic"/>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Nixie+One:regular,italic,bold,bolditalic"/>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Alegreya+SC:regular,italic,bold,bolditalic"/>

    <!-- css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css" media="screen"/>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.js"></script>
    <![endif]-->

    <!--[if IE 8]>
    <script src="assets/js/selectivizr.js"></script>
    <![endif]-->
</head>

<body>

<div id="wrapper">
<div id="header" class="content-block header-wrapper">
    <div class="header-wrapper-inner">
        <section class="top clearfix">
            <div class="pull-left">
                <h1><a class="logo" href="index.php">Party</a></h1>
            </div>
        </section>

        <section class="center" style="margin-top: 90px;">
            <div class="slogan">
                Party
            </div>
            <div class="secondary-slogan">
                Незабаром
            </div>
        </section>

        <div id="timer" class="container">
            <div class="row">
                <div id="countdown">
                    <div class="countdown-section"><b class="first">03</b> <span>днів</span></div>
                    <div class="countdown-section"><b class="second">11</b> <span>годин</span></div>
                    <div class="countdown-section"><b class="third">46</b> <span>хвилин</span></div>
                    <div class="countdown-section"><b class="fourth">14</b> <span>секунд</span></div>
                </div>
            </div>
        </div>

        <a id="scrollToContent" href="#contact">
            <img src="/lesson_18/my-flusk/assets/images/arrow_down.png">
        </a>
    </div>
</div>
<!-- header -->

<div class="content-block" id="contact">
    <div class="container text-center">
        <header class="block-heading cleafix">
            <h1> Прийняти участь </h1>
        </header>
        <div class="container block-body">
            <div class="row col-xs-12">

                <div style="display: inline-flex; font-size: 16px"
                     class="col-xs-4 col-sm-3 col-md-3 col-xl-3 for_price_list">
                    <ul class="price_list">
                        <li style="text-transform: uppercase; font-weight: 600;font-size: 20px;"> Ціна</li>
                        <li> Дівчатам - безкоштовно
                            <hr>
                        </li>
                        <li> Хлопцям - 150$
                            <hr>
                        </li>
                        <li> Парам - 100$</li>
                    </ul>
                </div>

                <div class="col-xs-7">
                    <div id="content">


                        <form method="post" action="index.php">

                            <select class="select2-single form-control" id="form-last-name" name="sex">
                                <option value="0">Хто прийде на вечірку?</option>
                                <option value="1">Дівчина</option>
                                <option value="2">Хлопець</option>
                                <option value="3">Пара</option>
                            </select>

                            <div class="form-group">
                                <input class="form-control form-control-white" id="subject" placeholder="Ваше ім'я"
                                       name="name">
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-white" id="exampleInputEmail2"
                                       placeholder="Email" name="email" type="email">
                            </div>

                            <button class="submit_button" type="submit"> Підтвердити</button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- #contact -->


<div class="content-block parallax" id="services">
    <div class="container text-center">
        <header class="block-heading cleafix">
            <h1 style="text-transform: uppercase;">Прийдуть</h1>
        </header>
        <section class="block-body">
            <div class="row">
                <div class="col-md-4" style="border-right: 1px white solid;">
                    <div class="service">
                        <?PHP
                        $sql_girl = "SELECT count(sex) FROM party where sex = 1";
                        $result_girl = mysqli_query($connection, $sql_girl);
                        $row_girl = mysqli_fetch_array($result_girl);
                        ?>
                        <span><?= $row_girl[0] ?></span>

                        <?php
                        if ($row_girl[0] == 0) {
                            ?>
                            <h2><?= "Дівчат" ?></h2>

                        <?php
                        } elseif ($row_girl[0] == 1) {
                            ?>
                            <h2><?= "Дівчина" ?></h2>
                        <?php
                        } elseif ($row_girl[0] == 22 or $row_girl[0] == 32) {
                            ?>
                            <h2><?= "Дівчини" ?></h2>
                        <?php
                        } else {
                            ?>
                            <h2><?= "Дівчат" ?></h2>
                        <?php
                        }
                        ?>
                    </div>
                </div>


                <div class="col-md-4" style="border-right: 1px white solid;">
                    <div class="service">
                        <?PHP
                        $sql_boy = "SELECT count(sex) FROM party where sex = 2";
                        $result_boy = mysqli_query($connection, $sql_boy);
                        $row_boy = mysqli_fetch_array($result_boy);
                        ?>
                        <span><?= $row_boy[0] ?></span>

                        <?php
                        if ($row_boy[0] == 0) {
                            ?>
                            <h2><?= "Хлопців" ?></h2>

                        <?php
                        } elseif ($row_boy[0] == 1) {
                            ?>
                            <h2><?= "Хлопець" ?></h2>
                        <?php
                        } elseif ($row_boy[0] == 22 or $row_boy[0] == 32) {
                            ?>
                            <h2><?= "Дівчини" ?></h2>

                        <?php
                        } else {
                            ?>
                            <h2><?= "Хлопців" ?></h2>

                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="service">
                        <?PHP
                        $sql_couple = "SELECT count(sex) FROM party where sex = 3";
                        $result_couple = mysqli_query($connection, $sql_couple);
                        $row_couple = mysqli_fetch_array($result_couple); ?>

                        <span><?= $row_couple[0] ?></span>

                        <?php
                        if ($row_couple[0] == 0) {
                            ?>
                            <h2><?= "Пар" ?></h2>

                        <?php
                        } elseif ($row_couple[0] == 1) {
                            ?>
                            <h2><?= "Пара" ?></h2>

                        <?php
                        } elseif ($row_couple[0] >= 2 && $row_couple[0] <= 4) {
                            ?>
                            <h2><?= "Пари" ?></h2>
                        <?php
                        } elseif ($row_couple[0] == 22 or $row_couple[0] == 32) {
                            ?>
                            <h2><?= "Дівчини" ?></h2>

                        <?php
                        } else {
                            ?>
                            <h2><?= "Пар" ?></h2>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- #services -->


</div>
<!--/#wrapper-->


<script>
    function Timer(){

        var endTime = new Date('2017-12-31 23:59:59.999');

        if (new Date() > endTime) {

            clearInterval(timer);

        } else {

// get total seconds between the times
            var delta = Math.floor((endTime - new Date()) / 1000);
// calculate (and subtract) whole days
            var days = Math.floor(delta / 86400);
            delta -= days * 86400;
// calculate (and subtract) whole hours
            var hours = Math.floor(delta / 3600) % 24;
            delta -= hours * 3600;
// calculate (and subtract) whole minutes
            var minutes = Math.floor(delta / 60) % 60;
            delta -= minutes * 60;
// what's left is seconds
            var seconds = delta % 60;

            document.getElementsByClassName('first')[0].innerHTML = days;
            document.getElementsByClassName('second')[0].innerHTML = hours;
            document.getElementsByClassName('third')[0].innerHTML = minutes;
            document.getElementsByClassName('fourth')[0].innerHTML = seconds;

        }
    }
    var timer = setInterval(Timer, 1000);

    Timer();

</script>

<script src="assets/js/jquery-2.1.3.min.js"></script>
<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.actual.min.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/script.js"></script>

</body>
</html>


