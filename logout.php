<?php 
define('ACC',true);
require('./include/init.php');
session_start();
session_destroy();
$msg = '退出成功';

include(ROOT.'view/front/msg.html');
?>