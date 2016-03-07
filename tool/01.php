<?php
define('ACC',true);
require('../include/init.php');

$uptool = new UpTool();

if($res=$uptool->up('avatar')){
	echo 'OK';
	echo $res;
}else{
	echo 'shibai';
	echo $uptool->getErr();
}
?>