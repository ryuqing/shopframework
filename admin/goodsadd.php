<?php 
header("Content-type: text/html; charset=utf-8"); 
define('ACC',true);
require('../include/init.php');
$cat = new CatModel();
$catelist = $cat->select();
$catelist = $cat->getCatTree($catelist);
include(ROOT.'view/admin/templates/goodsadd.html');
?>
