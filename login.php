<?php 
define('ACC',true);
require('./include/init.php');

if(isset($_POST['act'])){
	//html这边设置了hiden 接收过来校验 说明点击了登录按钮
	//收用户名/密码，验证。。。。
	$u = $_POST['username'];
	$p = $_POST['passwd'];
	//检验 自己做就行
	$user = new usermodel();
	//核对用户名密码
	$row = $user->checkUser($u,$p);
	
	if(empty($row)){
		$msg = '用户名密码不匹配';
	}else {
		$msg = '登录成功';
		session_start();
		$_SESSION = $row;

		//如果勾选了记住用户名，本地记住
		if(isset($_POST['remember'])){
			setcookie('remuser',$u,time()+14*24*36);
		}else{
			setcookie('remuser','',0);
		}
		print_r($_COOKIE);
	}
	include('./view/front/msg.html');
	exit();
}else{

	$remuser = isset($_COOKIE['remuser'])?$_COOKIE['remuser']:'';
	include('./view/front/denglu.html');
}
?>