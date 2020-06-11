<?php include("connection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<style>
    .alert-danger {
        position: absolute;
    }
</style>

<div id="headerwrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <h4>HELLO, MY NAME IS</h4>
                <h1>IKATOR</h1>

                <input id="url">

                <p class="mt">
                    <button type="button" class="btn btn-cta btn-lg">LOAD IMAGE</button>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row centered mt mb">
        <h1 class="selectTheme">Select template</h1>

        <?php
        $select = "select * from template";
        $result = mysqli_query($connection, $select);

        while ($row = mysqli_fetch_array($result)) {

        ?>
        <div class="col-lg-4 col-md-4 col-sm-4 gallery">
                <img src="<?=$row["url"]?>" class="img-responsive" onclick="sendImage(<?= $row["fontSizeTZ"]?>, <?= $row["fontSizeNC"]?>,
                <?= $row["xTZ"]?>, <?= $row["yTZ"]?>,
                <?= $row["xNC"]?>, <?= $row["yNC"]?>)">
        </div>

        <?php } ?>
        <!--<div class="col-lg-4 col-md-4 col-sm-4 gallery">
            <a href="#"><img src="https://sun9-7.userapi.com/c834301/v834301291/e5464/H5BuQrC9Bpo.jpg"
                             class="img-responsive"></a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 gallery">
            <a href="#"><img src="https://sun9-7.userapi.com/c824202/v824202228/d6fe6/GdkLqbNj5Wk.jpg"
                             class="img-responsive"></a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 gallery">
            <a href="#"><img src="https://sun9-7.userapi.com/c840726/v840726313/55827/uhuMN6J7q8s.jpg"
                             class="img-responsive"></a>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 gallery">
            <a href="#"><img src="https://sun9-6.userapi.com/c824501/v824501167/b02aa/lMEm2xR_j0c.jpg"
                             class="img-responsive"></a>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 gallery">
            <a href="gd.php"><img src="https://pp.userapi.com/c840322/v840322645/2bafd/9XWe0o8Hy60.jpg"
                             class="img-responsive"></a>
        </div>-->

    </div>
</div>

<script>
        function sendImage (fontSizeTZ, fontSizeNC, xTZ, yTZ, xNC, yHC) {
            var inputValue = document.getElementById("url").value;

            var myRegex = /(https?:\/\/.*\.(?:png|jpg))/i;

            if (myRegex.test(inputValue)) {

            } else {
                document.getElementsByClassName("selectTheme")[0].innerHTML = "You entered invalid URL";

            }
        }
</script>

</body>
</html>
