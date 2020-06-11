<?php
$img = imagecreatefromjpeg("http://www.luxephotos.zachalo.ru/winter/per-02.jpg");
header('Content-Type: image/jpeg');

$white = imagecolorallocate($img, 255, 255, 255);

$font_file = './LT.ttf';

imagefttext($img, 40, 0, 50, 50, $white, $font_file, $_GET["main_name"]);

imagejpeg($img);
