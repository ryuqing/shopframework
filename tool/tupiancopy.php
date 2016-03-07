<?php 
/*把一副小图复制到大图上去，复制2份，形成证件照片的效果
小图：330*379
大图的宽 330*2+20，高379
-------这是原样复制的例子-----------
*/
$sw=330;
$sh=379;

//创建大图画面
$big=imagecreatetruecolor($sw*2+20, 379);
//创建灰色
$gray= imagecolorallocate($big, 200, 200, 200);
//填充大图
imagefill($big, 0, 0, $gray);

$small=imagecreatefrompng(‘./feng.png);

//复制小图
imagecopy($big, $small, 0, 0, 0, 0, 330, 379);
imagecopy($big, $small, $sw+20, 0, 0, 0, 330, 379);

//输出
header('content-type:image/png');



?>