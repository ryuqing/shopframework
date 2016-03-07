<?php 



/*1、将1234567890转换成1,234,567,890 每3位用逗号隔开的形式。*/

function change($str){
	$str=strrev($str);
	$str=str_split($str,3);
	print_r($str);
	$str=strrev(implode(',', $str));
	return $str;
}
$str='1234567890';
echo change($str);


?>