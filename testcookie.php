<?php 
if(!isset($_COOKIE['num'])){
	$num = 1;
	setcookie('num',$num);
}else{
	$num = $_COOKIE['num'];
	setcookie('num',$num+1);
}
echo '这是你的第'，$num,'次访问';

?>