<?php 
/*
=====笔记部分======
问：复制的图片能否小一点呢？
复制的图片能否带点透明效果呢？

答：能。
用imagecopyresampled
imagecopymerge
*/
/*
bool imagecopyresampled(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
这个是复制图片并允许调整大小（可以做缩略图）
*/
$ow=330;
$oh=379;

$nw=(int)$ow/2; //缩略宽度
$nh=(int)$oh/2; //缩略高度 

//创建缩略图画面
$dst = imagecreatetruecolor($nw, $nh)
$src=imagecreatetruecolor($ow, $oh);

//复制完毕
imagecopyresampled($dst, $src, 0, 0, 0, 0, $ow, $oh, $nw, $nh);

//输出
imagepng($dst,'./feng.png');
$imagedestroy($dst);
?>