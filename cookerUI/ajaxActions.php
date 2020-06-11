<?php
require_once('Database.php');
$db = new DataBase();

if ($_POST['action'] == 'getDishesType') {
    $db->select(['id', 'name'], 'dishTypes', []);

    $data = [];
    while ($row = $db->getRow()) {
        $data[] = ["dishTypeName" => $row['name'], 'id' => $row['id']];
    }
    echo json_encode($data);
} elseif ($_POST['action'] == 'getDishesTitle') {
    $db->select(['dishName', 'JSONrecipe'], 'dishes', ['typeID' => $_POST['typeID']]);

    $data = [];
    $cnt = 0;
    while ($row = $db->getRow()) {
        $cnt++;
        if ($cnt == 1) {
            continue;
        }
        $data[] = ["dishTitle" => $row['dishName'], 'recipe' => $row['JSONrecipe']];
    }
    echo json_encode($data);
} elseif ($_POST['action'] == 'updateArray') {
    $db->updateQueryScalar('dishes', ['JSONrecipe' => $_POST['array']], ['dishName' => $_POST['dishName']]);
} elseif ($_POST['action'] == 'newDishType') {
    $typeID = $_POST['typeID'];
    $db->insertItemQuery('dishes', ['typeID' => $typeID, 'complete' => 'false']);
} elseif ($_POST['action'] == 'newDishTitle') {
    $db->updateQueryScalar('dishes', ['dishName' => $_POST['recipeTitle']], ['complete' => 'false']);
} elseif ($_POST['action'] == 'insertWholeRecipe') {
    $imageURL = $_POST['imageURL'];
    $array = $_POST['array'];
    $db->updateQueryScalar('dishes', ['image' => $imageURL, 'JSONrecipe' => $array], ['complete' => 'false']);
    $db->updateQueryScalar('dishes', ['complete' => 'true'], ['complete' => 'false']);
}