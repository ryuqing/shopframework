<?php
/*==========笔记部分=========
递归对数组进行转义
*/
function _addslashes($arr){
	foreach ($arr as $k => $v) {
		if(is_string($v)){
			$arr[$k]=addslashes($v);

		}else if (is_array($v)) {
			$arr[$k]=_addslashes($v);  //再次赋给当前单元
		}	

	}
	return $arr;
}



?>