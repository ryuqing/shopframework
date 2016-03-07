<?php 
/****
init要完成
1：计算ROOT即根目录
2：定义调试模式
3；引入最基础的类
4：递归过滤参数   $_GET,$_POST..
5：日志功能
****/
 header("Content-type: text/html; charset=utf-8"); 
 /*
框架初始化：
//1过滤参数，用递归的方式过滤$_GET,$_POST,$_COOKIE,暂时不会
 */
//2初始化当前绝对路径
//换成正斜线是因为win/linux都支持正斜线，而linux不支持反斜线，所以才这样
define ('ROOT',str_replace('\\','/',dirname(dirname(__FILE__))).'/');
//3设置报错级别error_reporting();
defined('ACC')||exit('ACC Denied');
require(ROOT.'include/db.class.php');
require(ROOT.'include/mysql.class.php');
require(ROOT.'Model/Model.class.php');
require(ROOT.'Model/CateModel.class.php');
require(ROOT.'Model/CatModel.class.php');
require(ROOT.'Model/TestModel.class.php');
require(ROOT.'Model/GoodsModel.class.php');
require(ROOT.'include/conf.class.php');
require(ROOT.'include/log.class.php');
require(ROOT.'include/lib_base.php');
require(ROOT.'tool/UpTool.class.php');
require(ROOT.'tool/ImageTool.class.php');
require(ROOT.'Model/UserModel.class.php');

//上面引用的类是不是有点多？所以我们要用自动加载解决 PS: 我这个自动加载没有测试成功

  /*
 function __autoload($class){
 	if(strtolower(substr($class, -5))=='model'){
 		require(ROOT.'Model/'.$class.'.class.php');
 	}else {
 		require(ROOT.'include/'.$class.'.class.php');
 	}
 }

 */
 //过滤参数 
 $_GET=_addslashes($_GET);
 $_POST=_addslashes($_POST);
 $_COOKIE=_addslashes($_COOKIE);

define('DEBUG',true);
if(defined('DEBUG')){       //如果dubug定义了就是调试模式就尽量报错
	error_reporting(E_ALL);
}else{
	error_reporting('0');    //如果dubug没定义就都不报 为了安全性
}

?>