<?php
session_start();

$captcha_text = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 6);


$_SESSION['captcha_code'] = $captcha_text;


$width = 120;
$height = 40;
$image = imagecreatetruecolor($width, $height);


$bg_color = imagecolorallocate($image, 255, 255, 255); 
$text_color = imagecolorallocate($image, 0, 0, 0); 
$line_color = imagecolorallocate($image, 64, 64, 64); 


imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);


for ($i = 0; $i < 5; $i++) {
    imageline($image, 0, rand(0, $height), $width, rand(0, $height), $line_color);
}


$font_size = 5; 
$x = 10;
$y = 10;
imagestring($image, $font_size, $x, $y, $captcha_text, $text_color);


header("Content-Type: image/png");

imagepng($image);
imagedestroy($image);
?>
