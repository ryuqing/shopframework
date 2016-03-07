<?php 

 header("Content-type: text/html; charset=utf-8"); 
 /*
所以的用户访问的页面都是要先加载init.php
 */
require('./include/init.php');
$mysql=msql::getIns();
$test =new TestModel();
var_dump($test->reg(array('name'=>'adminuser1','email'=>'adminuser2')));
 ?>