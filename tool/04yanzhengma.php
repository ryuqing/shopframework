<?php 
/*
=====笔记======
验证码！
验证码不就是有字母的图片吗？
一.造图片
二.写字（不会） 用imagestr
*/
//1造画布
$im=imagecreatetruecolor(50,25);

//不填充，同学们看看默认画布是什么底色？

//2 造颜料准备写字
$red=imagecolorallocate($im,255,0,0);
//填充个浅色背景
$gray=imagecolorallocate($im, 50, 50, 50);
//随机颜色
$randcolor= imagecolorallocate($im, mt_rand(0,150), mt_rand(0,150),mt_rand(0,150));
$linecolor1= imagecolorallocate($im, mt_rand(150,210), mt_rand(150,210),mt_rand(150,210));
$linecolor2= imagecolorallocate($im, mt_rand(150,210), mt_rand(150,210),mt_rand(150,210));
$linecolor3= imagecolorallocate($im, mt_rand(150,210), mt_rand(150,210),mt_rand(150,210));

//填充背景
imagefill($im, 0, 0, $gray);

//画干扰线
imageline($im, 0, mt_rand(0,25), 50, mt_rand(0,25), $linecolor1);
imageline($im, 0, mt_rand(0,25), 50, mt_rand(0,25), $linecolor2);
imageline($im, 0, mt_rand(0,25), 50, mt_rand(0,25), $linecolor3);


/*
3.写字
imagestring--水平地画一行字符串

说明
bool imagestring ( resource $image , int $font , int $x , int $y , string $s , int $col )
参数分别代表:画布资源，字体大小（1-5中选择），字符最左上角的x坐标，y坐标，要写的字符串，颜色
*/
$str ='ABCDEFGHIJKMNPQRSTabcdefghijkmnpqrstuvwxyz23456789';
$str=substr(str_shuffle($str),0,4);


imagestring($im,5,8,5,$str,$randcolor);
header('content-type: image/png');
imagepng($im);

/*
销毁s
*/

imagedestroy($im);

?>