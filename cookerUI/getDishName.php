<?php
require_once('Database.php');
$db = new DataBase();
$db->select(['dishName', 'JSONrecipe'], 'dishes', []);

$data = [];

while ($row = $db->getRow()) {
    $data[] = ["name" => $row['dishName']];
}
echo json_encode($data);
