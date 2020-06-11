<?php
/*class notMassive {
    public function get_array(...$int) :iterable {
        return $int;
    }
}

$ob = new notMassive();

foreach ($ob->get_array(1,2,3,4,5,6,7,8,9,10) as $int) {
    echo $int;
}*/

/*function noRange($from, $to) {
    for ($i = $from; $i <= $to; $i++) {
        yield $i;
    }
}

foreach (noRange(1, 10) as $number) {
    echo $number;
}*/


?>
<?php
include("common_var.php");
?>
<!DOCTYPE html>
<html>
<head>
    <!-- <link href="style.css" type="text/css" rel="stylesheet"/>-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
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
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-7">
            <table class="table table-hover" id="main_table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Url</th>
                    <th scope="col">Admin</th>
                </tr>
                </thead>
                <?php

                //get posts list
                $query = "SELECT post_id, date, admin FROM vk_post ORDER BY date DESC";
                $result = mysqli_query($connection, $query);

                $admins_id = [];
                $rows = [];

                //ЗАПИСУЄМО В МАСИВ РЕЗУЛЬТАТ SQL ЗАПИТУ
                while ($a_row = mysqli_fetch_array($result)) {
                    $rows[] = $a_row;
                }

                $massive = [];
                $unique_ids[] = array_unique(array_column($rows, 'admin'));

                //РОБИМО ЗАПИТ З ЦИЦМИ АЙДІШКАМИ
                $get_adm_names = $VkApi->api("users.get", [
                    "access_token" => ACCESS_TOKEN,
                    "user_ids" => $unique_ids[0]
                ]);
                foreach ($get_adm_names["response"] as $item) {
                    $massive[$item["id"]] = $item["first_name"] . " " . $item["last_name"];
                }

                foreach ($rows as $a_row) {
                    $post_url = "https://vk.com/wall-26363301_" . $a_row["post_id"];
                    ?>
                    <tr>
                        <td><?= $a_row["date"] ?></td>
                        <td><a href="<?= $post_url ?>"><?= $post_url ?></a></td>
                        <td><?= $massive[$a_row["admin"]] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <div class="admin col-3" style="text-align: center; font-size: 20px">
            <?php
            $select = "SELECT admin, COUNT(post_id) FROM vk_post GROUP BY admin ORDER BY COUNT(post_id) DESC";
            $result = mysqli_query($connection, $select);

            while ($count = mysqli_fetch_array($result)) { ?>
                <div class="one_admin" style="margin-bottom: 20px">
                    <p><?= $massive[$count["admin"]] ?></p>

                    <span style="border: 1px solid; border-radius: 100%; padding: 15px;"> <?= $count["COUNT(post_id)"] ?></span>
                </div>
                <?php
            }

            ?>
            <hr style="width: 100%; border: 2px solid;">
            <?php
            $amount = "SELECT MAX(a_id) FROM vk_post";
            $get_post_amount = mysqli_query($connection, $amount);
            $row = mysqli_fetch_array($get_post_amount);
            $max_post_id = $row["MAX(a_id)"];
            ?>
            <p> <?= $max_post_id ?></p>
        </div>

        <div class="col-sm-2">
            <table class="table table-hover" id="main_table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Post count</th>
                </tr>
                </thead>
                <tr>

                    <?php
                    $today_date = date("Y-m-d");
                    $yesterday = date("Y-m-d", strtotime("-1 days"));
                    echo $today_date;
                    echo $yesterday;
                    $select_count = "SELECT COUNT(post_id) FROM vk_post WHERE (date BETWEEN '$yesterday' AND '$today_date')";

                    $result = mysqli_query($connection, $select_count);

                    while ($count = mysqli_fetch_array($result)) { ?>
                        <td><?= $yesterday ?></td>
                        <td><?= $count[0] ?></td>
                    <?php } ?>

                </tr>
            </table>
        </div>

    </div>
    <form method="get" action="add_post.php?insert">
        <button type="submit" name="insert"> INSERT</button>
    </form>
</div>
</body>
