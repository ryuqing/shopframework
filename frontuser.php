<?php 

 header("Content-type: text/html; charset=utf-8"); 
 defined('ACC',true);
 require('./include/init.php');
 /********
以往的做法是：
接收数据    检验数据  拼凑sql，并执行 判断返回值
现在的MVC开发方式：
接收数据  检验数据
把数据交给model去写入数据库 并判断model返回值
 *******/
//接收

$data['catename']=$_POST['catename'];
$data['intro']=$_POST['intro'];
//关于名称的检测，如有无重复。此处不掩饰
//调用model，来执行
$cateModel=new CateModel();
if($cateModel->add($data)){
	$res=true;
}else{
	$res=false;
}
//把结果展示到view里。此处直接打印
echo $res?'成功':'失败le';





 ?>