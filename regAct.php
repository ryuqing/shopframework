<?php 
define('ACC',true);
require('./include/init.php');
$user = new UserModel();

/*
调用自动检验功能
检验用户4-16字符之内
email检测
passwd不能为空
*/
if(!$user->_validate($_POST)){
	$msg = implode('<br />', $user->getErr());
	include(ROOT.'view/front/msg.html');
	exit;	
}

//检验用户名是否已经存在
if($user->checkUser($_POST['username'])){
	$msg = '用户名已经存在';
	include(ROOT.'view/front/msg.html');
	exit;
}

$data = $user->_autoFill($_POST);  // 自动填充
$data = $user->_facade($data);  // 自动过滤


if($user->reg($data)){
	$msg = '用户注册成功';
}else{
	$msg = '用户注册失败';
}

//引入view
include(ROOT.'view/front/msg.html');
?>