<?php 

 header("Content-type: text/html; charset=utf-8"); 
 /*
所以的用户访问的页面都是要先加载init.php
 */
require('./include/init.php');
print_r($_GET);
echo '<br />';
$msql=msql::getIns();
//$msql->switchDb('myshop');
$sql="insert into tshop(name ,email) values('test10','test10@qqgoole.com')";
var_dump($msql->query($sql));
 ?>