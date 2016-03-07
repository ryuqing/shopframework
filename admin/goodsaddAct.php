<?php 
define('ACC',true);
require("../include/init.php");
$goods= new GoodsModel();
$_POST['goods_weight'] *=$_POST['weight_unit'];
print_r($_POST);
$data = array();
$data = $goods->_facade($_POST);//自动过滤
/*
//这只是一个示例，做数据的检验
$data['goods_name']=trim($_POST['goods_name']);
if($data['goods_name']==''){
	echo '商品名不能为空';
	exit;
}
$data['goods_sn']=trim($_POST['goods_sn']);
$data['cat_id']=$_POST['cat_id']+0;
$data['shop_price']=$_POST['shop_price']+0;
$data['goods_desc']=$_POST['goods_desc'];
$data['goods_weight']=$_POST['goods_weight']*$_POST['weight_unit'];
$data['is_best']=isset($_POST['is_best'])?1:0;
$data['is_new']=isset($_POST['is_new'])?1:0;
$data['is_hot']=isset($_POST['is_hot'])?1:0;
$data['is_on_sale']=isset($_POST['is_on_sale'])?1:0;
$data['goods_brief']=trim($_POST['goods_brief']);
$data['add_time']=time();
*/
$data= $goods->_autoFill($data);//自动填充
if(empty($data['goods_sn'])){
	$data['goods_sn'] = $goods->createSn();
}

/*171课，上传图片*/
$uptool= new UpTool();
$ori_img=$uptool->up('ori_img');
if($ori_img){
	$data['ori_img']=$ori_img;
}

/*179课 如果$ori_img上传成功，再次生成中等大小缩略图 300*400*/
if($ori_img){
	$ori_img = ROOT.$ori_img; // 加上绝对路径

	$goods_img = dirname($ori_img) . '/goods_' . basename($ori_img);
	if(ImageTool::thumb($ori_img,$goods_img,300,400)){
		$data['goods_img'] = str_replace(ROOT, '', $goods_img);
	}

	//再次生成浏览时用的缩略图 160*220
	//定好缩略图的地址
	//aa.jpeg --> thumb_aa.jpeg
	$thumb_img = dirname($ori_img) . '/thumb_' . basename($ori_img);
	if(ImageTool::thumb($ori_img,$goods_img,160,220)){
		echo str_replace($thumb_img, ROOT, '');
		$data['thumb_img'] = str_replace($thumb_img, ROOT, '');
	}
}

print_r($data);


if($goods->add($data)){
	echo '商品发布成功';
}else{
	echo '商品发布失败';
}
?>