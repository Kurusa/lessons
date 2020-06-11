<?php
include('log_in.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="style.css" type="text/css" rel="stylesheet"/>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Neucha:200,300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
            integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
            crossorigin="anonymous"></script>
</head>
<body style="font-family: Neucha, cursive;">

<div class="<?php echo $time; ?>" id="main">
    <div class="black">

        <p class="top_sentence"> Login and Registration Form </p>

        <div class="container">
            <div class="row">
                <div class="col-sm-5 flex-container">
                    <p> We are happy to see you again :3 </p>

                    <?php if (isset($_POST['hidden_login'])) {
                            $login_name = addslashes(strip_tags($_POST['login_name']));
                            $check_name = "select count(*) FROM blog_users WHERE name = '$login_name'";
                            $result = mysqli_query($connection, $check_name);
                            $row = mysqli_fetch_row($result);
                            if ($row[0] = 0) {
                            ?>
                            <div class="taken_name"><?="User not found or password not correct"?></div>
                        <?php
                        }
                    }?>

                    <?php if (isset($_POST['hidden_login'])) {
                        if (strlen($_POST['login_name']) < 3 or strlen($_POST['login_pass']) < 2) {
                            ?>
                            <div class="taken_name"><?="User not found"?></div>
                        <?php
                        }
                    }?>

                    <form action="html_log_in.php" method="post" name="login_submit">

                        <div>
                            <input placeholder="your name" style="margin-bottom: 30px;" class="flex-element" type="text"
                                   name="login_name">
                        </div>

                        <div>
                            <input placeholder="and password" style="margin-bottom: 30px;" class="flex-element"
                                   type="password" name="login_pass" min="5" maxlength="15">
                        </div>

                        <input type="hidden" name="hidden_login">

                        <div>
                            <button class="button flex-element" type="submit" name="login_submit"
                                    style="font-size: 23px;"> I`m ready
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-2 middle-border"></div>

                <div class="col-sm-5 flex-container">
                    <p> Quick registration </p>

                    <?php if (isset($_POST['hidden_registration'])) {
                        if ((!preg_match("/^[a-zа-я0-9_]{3,15}$/", $_POST['reg_name'])) or (!preg_match("/^[a-zа-я0-9_]{3,15}$/", $_POST['reg_pass']))) {
                            ?>
                            <div class="taken_name"><?="Sorry, your name or pass has unacceptable symbols"?></div>
                        <?php
                        }
                    }?>

                    <?php if (isset($_POST['hidden_registration'])) {
                        if (strlen($_POST['reg_name']) >= 3 or strlen($_POST['reg_pass']) >= 2) {
                            $hash = password_hash($_POST['reg_pass'], PASSWORD_DEFAULT);
                            /*хеш пароля*/
                            $name = addslashes(strip_tags($_POST['reg_name']));
                            /*очистить от всякой нечисти*/

                            $name_count = "select count(*) FROM blog_users WHERE name = '$name'";
                            /*проверяем, если ли в таблице такое имя*/
                            $result = mysqli_query($connection, $name_count);
                            /*исполняем запрос*/
                            $row = mysqli_fetch_row($result);
                            /*в массив*/
                            if ($row[0] > 0) {
                                ?>
                                <div class="taken_name"><?= "Sorry, this name has been already taken" ?></div>
                            <?php
                            }
                        }
                    }
                    ?>


                    <form action="html_log_in.php" method="post">
                        <div>
                            <input placeholder="Enter your name" style="margin-bottom: 30px;" class="flex-element"
                                   type="text"
                                   name="reg_name">
                        </div>
                        <div>
                            <input placeholder="and password" style="margin-bottom: 30px;" class="flex-element"
                                   type="password" name="reg_pass" min="5" maxlength="15">
                        </div>
                        <div>


                            <input type="hidden" name="hidden_registration">

                            <button class="button flex-element" type="submit" name="registration_submit"
                                    style="font-size: 23px; margin-left: 10px">
                                I`m ready
                            </button>
                        </div>

                    </form>
                </div>


            </div>
        </div>

    </div>

</div>


<!--myusername or mymail@mail.com-->

</body>
</html>