<?php
session_start();
$code=rand(1000,9999);
$_SESSION["captcha"]=$code;
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
$image = imagecreatetruecolor(172, 34);
$background = imagecolorallocate($image, 255, 255, 255);
$forground = imagecolorallocate($image, 0, 0, 0);
imagefill($image, 0, 0, $background);
imagestring($image, 5, 70, 10,  $_SESSION['captcha'], $forground);
imagepng($image);
imagedestroy($image);