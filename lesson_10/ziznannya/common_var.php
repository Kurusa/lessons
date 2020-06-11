<?php
$connection = mysqli_connect("localhost", "kurusa_test", "4HtyhPCfuy");
mysqli_select_db($connection, "kurusa_test");
mysqli_query($connection, "SET NAMES utf8");
//---------------------------------------
const ACCESS_TOKEN = "b8761f546c957ccba068af0ede70214baae4a0f52153b0fc7f71257c96342925350c3a2b0151928072229";
const GROUP_ID = -26363301;
const APP_ID = 6380720;
const APP_KEY = "nsFYajXVJtE8OcuXbHiX";
const REDIRECT_URI = "https://oauth.vk.com/blank.html";
const SCOPE = "wall, offline, photos";
//--------------------------------------------
include("../vk_photos/class/Vk.api.php");
session_start();
ini_set('display_errors', 1);
$VkApi = new Vk();