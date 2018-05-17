<?php
session_start();
header("Content-Type: image/png");

$image = imagecreatetruecolor(350, 200);

$background_tint = rand(0,1);

$light = ['min'=>120,'max'=>255];
$dark = ['min'=>0,'max'=>120];

if($background_tint == 1){
	$bgPalette = $dark;
	$mainPalette = $light;
}else{
	$bgPalette = $light;
	$mainPalette = $dark;
}

$backgroundColor = imagecolorallocate($image, rand($bgPalette['min'],$bgPalette['max']), rand($bgPalette['min'],$bgPalette['max']), rand($bgPalette['min'],$bgPalette['max']));

imagefill($image,0,0, $backgroundColor);

for($i = 0;$i<10;$i++){
$color[$i] = imagecolorallocate($image, rand($mainPalette['min'],$mainPalette['max']), rand($mainPalette['min'],$mainPalette['max']), rand($mainPalette['min'],$mainPalette['max']));	
}

$white = imagecolorallocate($image, 255,255,255); 

$files = glob('public/fonts/*.ttf');

$char = "abcdefghijklmonpqrstuvwxyz0123456789";
$char = str_shuffle($char);
$length = rand(-8,-6);

$captcha = substr($char, $length);
$font = 'public/fonts/'.$files[0];



for($i=0;$i < rand(8,14);$i++){
	$rand = rand(0,2);
	if($rand==0){
		imageline($image, rand(0,350), rand(0,200), rand(0,200), rand(0,200), $color[rand(0,9)]);
	}
	if($rand==1){
		imagerectangle($image, rand(0,350), rand(0,200), rand(0,200), rand(0,200), $color[rand(0,9)]);
	}
	if($rand==2){
		imagearc($image, rand(0,350), rand(0,200), rand(0,350), rand(0,200), rand(0,350), rand(0,350), $color[rand(0,9)]);
	}

}


for($i=0;$i < strlen($captcha);$i++){
	imagettftext($image, rand(38,45), rand(-20,20), 10+($i*rand(38,43)), rand(80,120), $color[rand(0,9)],$files[rand(0,count($files))],$captcha[$i]);
}

imagepng($image);
imagedestroy($image);



$_SESSION['captcha'] = $captcha;
