<?php
$array = [
    [ //1 massive
        "photo" => "https://pp.userapi.com/c630431/v630431751/6b15b/NRzBcjOdhB0.jpg",
        "id" => "48681751",
        "name" => "Жекі",
        "friends" => [
            "a",
            "b"
        ]
    ],

    [ //2 massive
        "photo" => "https://pp.userapi.com/c837431/v837431555/47447/XIIpZaV1DvY.jpg",
        "id" => "377380555",
        "name" => "Мишечка Малишечка",
        "friends" => [
            "c",
            "d"
        ]
    ],

    [ //3 massive
        "photo" => "https://pp.userapi.com/c630420/v630420754/1187d/4hIMM-aYDls.jpg",
        "id" => "42934754",
        "name" => "Рижий Олександр",
        "friends" => [
            "i",
            "d"
        ]
    ]
];

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <title></title>
    <link href="style.css" type="text/css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://use.fontawesome.com/8aa4ff900d.js"></script>
</head>
<body>

<table>

    <thead>
    <tr>
        <th colspan="3" id="top_th">Друзья Бипача :3</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($array as $friend_massive) { ?>
        <tr>
            <th>
                <!-- <i class="fa fa-compress" aria-hidden="true" onclick="less_function()"></i> -->
                <img src="<?= $friend_massive["photo"] ?>">
            </th>

            <td>
                <a href="https://vk.com/id/<?= $friend_massive["id"]?>"> <?= $friend_massive["name"] ?> </a>

                <?php
                foreach ($friend_massive as $friend_key => $friend_element) {
                    ?>
                    <ul>
                        <?php foreach ($friend_element as $inside_element => $in) { ?>

                            <li> <?= $in["friends"] ?>
                            </li>


                        <?php
                        } ?>
                    </ul>
                <?php
                }
                ?>

            </td>

        </tr>

    <?php
    }
    ?>

    </tbody>
</table>


</body>
</html>
