<?php

$var = 'abcde';
$a = '$var';
$b = "$var";

var_dump($a,$b); // що виведе?
?>
<!DOCTYPE html>
<html>
<head>
    <link href="style.css" type="text/css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/8aa4ff900d.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<!------------------------ TOP NAVBAR ----------------------------------------------------->
<nav class="navbar navbar-expand-lg navbar-light bg-light"
     style="background: linear-gradient(135deg, #8c2ce0 0%,#4f187f 50%,#621db7 50%,#4f187f 50%)!important; color: #e2bad6 !important;">
    <a class="navbar-brand">К хуям</a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="/lesson_10/vk_photos/index.php" style="color:#e2bad6!important;">Photos
                <span class="sr-only">(current)</span></a>
        </div>
    </div>
</nav>


<div class="container content-holder">
    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-4 hidden-xs" id="post_block">

        </div>


        <div class="col-lg-5 col-md-5 col-sm-5">
            <form action="index_html.php" method="post">
                <div class="form-group">
                    <label>Post image url</label>
                    <input name="src" type="text" class="form-control src" id="exampleInputEmail1"
                           aria-describedby="emailHelp" placeholder="Enter image url">
                    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                </div>

                <div class="for_text">
                    <label>Post <strong>text</strong> for image</label>
                    <input type="text" name="text" class="form-control text" id="exampleInputEmail1"
                           aria-describedby="emailHelp" placeholder="Enter text for the post">
                </div>

                <div id="for_alert"></div>

                <input type="checkbox" name="checkme" value="yes" id="checkme"
                       style="margin-top: 10px!important;"><span> In queue </span>

                <button type="button" class="btn btn-primary" id="button" name="send">Submit</button>
            </form>
            <button type="button" class="check_last_post btn btn-primary"> Check last post</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $('#post_block').load('load_post.php');

        $("#button").click(function () {
            $.ajax({
                url: "main.php",
                type: "POST",
                data: {
                    text: $(".text").val(),
                    src: $(".src").val(),
                    checked: $("#checkme:checked" ).val(),
                    action: "add_post"
                },
                success: function (data) {
                    $('#post_block').load('load_post.php');
                    document.getElementsByClassName("text")[0].value = "";
                    document.getElementsByClassName("src")[0].value = "";
                    if (data === "empty") {
                        var alert = document.createElement('div');
                        alert.className = "alert alert-warning";
                        alert.innerHTML = "Please,<strong>enter something.</strong>";

                        document.getElementById("for_alert").appendChild(alert);

                        setTimeout(function () {
                            alert.parentNode.removeChild(alert);
                        }, 1000);
                    }
                }
            });
        });


        $(".check_last_post").click(function () {
            $.ajax({
                url: "check_last_post.php",
                type: "POST",
                success: function (data) {

                }
            })
        })

    });
</script>
</body>
