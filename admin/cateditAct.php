<?php 
define('ACC',true);
require('../include/init.php');
//接post、判断合法性
$data=array();
if(empty($_POST['cat_name'])){
	exit('栏目名不能为空');
}
$data['cat_name'] = $_POST['cat_name'];
$data['parent_id']=$_POST['parent_id'];
$data['intro']=$_POST['intro'];

$cat_id = $_POST['cat_id']+0;
/*
一个栏目A，不能修改成为A的子孙栏目的子栏目。
思考：如果B是A的后代，则A不能成为B的子栏目。
反之，B是A的后代，则A是B的祖先
因此，我们为A设定一个新的父栏目时，设为N
我们可以先查N的家谱树，即N的家谱树里，如果有A 则子孙差辈了
*/
//调用model来更改
$cat=new CatModel();
echo '你想修改',$cat_id,'栏目<br />';
echo '想修改他的新爹为',$data['parent_id'],'<br />';
echo $data['parent_id'],'栏目的家谱树是<br />';
$trees=$cat->getTree($data['parent_id']);
$flag=true;
foreach ($trees as $v) {//161课没懂
	if ($v['cat_id']==$cat_id) {//如果家谱树的id与传过来的id一样则相等
		$flag=false;
		break;
	}
}
if(!$flag){
	echo $cat_id,'是',$data['parent_id'].'的祖先';
}
exit;
if($cat->update($data,$cat_id)){
	echo '栏目修改成功';
	exit;
}else{
	echo '栏目修改失败';
	exit;
}
 ?>