<?php 
define('ACC',true);
require('./include/init.php');

session_start();
$goods = new GoodsModel();
$newlist = $goods->getNew(5);


include(ROOT.'view/front/index.html');
 ?>