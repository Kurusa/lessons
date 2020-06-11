<?php
session_start();

$connection = mysqli_connect("localhost", "kurusa_test", "4HtyhPCfuy");
mysqli_select_db($connection, "kurusa_test");
mysqli_query($connection, "SET NAMES utf8");

echo mysqli_error($connection);

$name = $_SESSION['name'];
$id = $_SESSION['id'];


if ($_POST['action'] == "add_post") {

	if (strlen($_POST['text']) >= 5) {

		if (isset($_POST['checkme']) && $_POST['checkme'] == 'yes') {

			$text = htmlspecialchars($_POST['text']);

			$date = date("Y-m-d H:i:s");

			$insert = "INSERT INTO post(user_id, content, checked, date) VALUES ('$id', '$text', 'true', '$date')";

			mysqli_query($connection, $insert);

		} else {
			$text = htmlspecialchars($_POST['text']);

			$date = date("Y-m-d H:i:s");

			$insert_f = "INSERT INTO post(user_id, content, checked, date) VALUES ('$id', '$text', 'false', '$date')";
			mysqli_query($connection, $insert_f);
		}
	}
} elseif ($_GET['action'] == "delete") {
	$post_id = $_GET['post_id'];

	$mysql_query = ("DELETE FROM post WHERE post_id='$post_id'");
	mysqli_query($connection, $mysql_query);

} elseif ($_POST['action'] == "add_film") {

	if (!empty($_POST['name']) && !empty($_POST['url'])) {

		if (preg_match('~https?://[\S.]+(?:jpg|jpeg|png)\b~', $_POST['url'])) {
			$name = $_POST["name"];

			$about = $_POST["about"];

			$url = $_POST["url"];
			$date = date("Y-m-d H:i:s");

			$film_insert = "INSERT INTO films(name, about, url, date) VALUES ('$name', '$about', '$url', '$date')";
			mysqli_query($connection, $film_insert);
		} else {
			$name = $_POST["name"];

			$about = $_POST["about"];

			$url = "https://pp.userapi.com/c309229/v309229760/43f9/3thQc8LvbXE.jpg";

			$date = date("Y-m-d H:i:s");

			$film_insert = "INSERT INTO films(name, about, url, date) VALUES ('$name', '$about', '$url', '$date')";
			mysqli_query($connection, $film_insert);
			header('Content-type: text/html; charset=utf-8');
		}
	}

} elseif ($_POST["action"] == "add_c") {
	if (strlen($_POST['text_c']) > 2) {

		$post_id = $_POST['post_id'];
		echo $post_id;

		$text = htmlspecialchars($_POST['text_c']);
		echo $text;

		$date = date("Y-m-d H:i:s");

		$user_name = $_SESSION['name'];
		echo $user_name;

		$add = "INSERT INTO comment(id_post, content, user_name, date) VALUES ('$post_id', '$text', '$user_name', '$date')";
		mysqli_query($connection, $add);
	}

} elseif ($_POST["action"] == "change_post") {

	if (strlen($_POST['text']) > 0) {
		$changed_content = htmlspecialchars($_POST['text']);

		echo $changed_content;

		$id_content = $_POST["post_id"];

		$update_content = "UPDATE post SET content = '$changed_content' WHERE post_id = $id_content";
		mysqli_query($connection, $update_content);//выполняем запрос
	}
}