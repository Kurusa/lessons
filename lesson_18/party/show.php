<?php

$connection = mysqli_connect("localhost", "kurusa_test", "4HtyhPCfuy");
mysqli_select_db($connection, "kurusa_test");

?>




    <!DOCTYPE html>
    <head>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
    </head>
<body>

<table>
    <tr>
        <th>Стать</th>
        <th>Ім'я</th>
        <th>Email</th>
    </tr>
    <?php
    $select = "SELECT party.sex, party.name, party.email FROM party";
    $result = mysqli_query($connection, $select);
    while ($row = mysqli_fetch_array($result)) {
        if ($row['sex'] == 1) {
            $row['sex'] = 'дівчина';
        } elseif ($row['sex'] == 2) {
            $row['sex'] = 'хлопець';
        } elseif ($row['sex'] == 3) {
            $row['sex'] = 'пара';
        }
    ?>

    <tr>
        <td><?=$row['sex']?></td>
        <td><?=$row['name']?></td>
        <td><?=$row['email']?></td>
    </tr>

    <?php }?>

</table>

</body>