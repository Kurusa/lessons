<?php
session_start();

include('post.php');
?>

<!DOCTYPE html>
<html>
<head>
    <link href="post.css?3" type="text/css" rel="stylesheet"/>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Muli:200,300,400,600,700" rel="stylesheet">
    <script src="https://use.fontawesome.com/8aa4ff900d.js"></script>
    <script src="/lesson_16/ajax.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<body style="background-color: #f5f4f2; font-family: Muli, sans-serif;">
<div class="container">
    <div class="row"> <!--TOP-->
        <div class="col-sm-9">
            <p class="lets_code"
               style="margin-top: 0; padding: 27px; width: 100%; font-size: 43px; text-transform: uppercase;">Let's
                code,
                <span style="font-size: 30px">
                <?= $_SESSION['name'] ?>
            </span>
            </p>
        </div>

        <div class="top_form" style="margin-left: 80px">
            <form style="position: relative; height: 100%;" method="post" action="html_post.php">
            <span style="display: grid; position: relative; height: 100%;">
            <button name="exit" id="exit">
                Log out
            </button>

                <span id="global">
                    <a href="html_global.php">
                        Global posts
                    </a>
                </span>

                <span id="films">
                    <a href="html_films.php">
                        Films
                    </a>
                </span>

            </span>
            </form>
        </div>
    </div>
    <!--TOP-->

    <div class="row">
        <div class="col-sm-8">

            <div id="comment_block"> <!--ПОСТЫ-->


            </div>
        </div>


        <!--ПОСТЫ-->

        <div class="col-sm-4" style="max-width: 344px"> <!--ДЛЯ ВВОДА ТЕКСТА-->
            <div style="margin-top: 15px" id="upper_textarea_words">
                <span> Wanna add a post? </span>
            </div>

            <form action="html_post.php" method="post" id="myform">

                <textarea id="textarea" placeholder="And your comment" name="posting"
                          style="font-size: 19px; margin-top: 25px"> </textarea>


                <input class="button" type="button" name="send" value="Send"
                       style="font-size: 23px; margin: 10px auto; color: black">


                <div class="checked" style="display: inline-flex">
                    <input type="hidden" name="checkme" value="0" id="checkme">
                    <input type="checkbox" name="checkme" value="yes" id="checkme" style="margin-top: 10px!important;"><span>Global post </span>
                </div>

            </form>

            <?php
            if (isset($_POST['send'])) {
                if (strlen($_POST['posting']) < 5) {
                    ?>
                    <div id="no"> <?= "Oh snap! Change a few things up and try submitting again." ?></div>
                <?php
                }
            }
            ?>

            <!--ДЛЯ ВВОДА ТЕКСТА-->

        </div>

    </div>

</div>


<script>

    $('#textarea').on('click', function (e) {
        e.preventDefault();
        $(this).css('border-color', '#cae5f8');
        $(this).css('border-width', '2px');
    });

    $(document).ready(function () {
        $('#comment_block').load('list_post.php');

        $(".button").click(function () {
            $.ajax({
                url: "all_functions.php",
                type: "POST",
                data: {
                    text: $("#textarea").val(),
                    checkme: $( "#checkme:checked" ).val(),
                    action: "add_post"
                },
                success: function () {
                    $('#comment_block').load('list_post.php');
                    document.getElementById('textarea').value = "";
                }
            })
        });

    });


</script>


</body>


