<?php 
/*接收 goods_id  调用trash方法*/
define('ACC',true);
require("../include/init.php");
if(isset($_GET['act']) && $_GET['act']=='show'){
	//这个部分是要打印所有的回收商品
	$goods = new GoodsModel();
	$goodslist= $goods->getTrash();
	include(ROOT . 'view/admin/templates/goodslist.html');

}else{
	/*为什么不直接删除？
	1：破坏了数据的完整性
	比如：淘宝上买了东西，并对商品做了评论，后来这些商品被删了，这些评论做何处理？
	又或者某人购买的商品记录没了
	2：影响查询的速度（对于大型网站，尤为严重）
	数据在硬盘上按格式存储[][][][][]
	删除一行，文件产生了一个’空洞’，影响索引，影响速度
	所以，像淘宝这样的网站，虽然每天的数据都非常多
*/
$goods_id=$_GET['goods_id']+0;
$goods=new GoodsModel();
if($goods->trash($goods_id)){
	echo '已进入回收站';
}else{
	echo '加入失败';
}
}
?>