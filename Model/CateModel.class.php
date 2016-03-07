<?php 
/****

****/
class CateModel extends Model{
	protected $table ='cate';//是model所控制的表
	public function add($data){
		return $this->db->autoEXecute($data,$this->table,'insert');//调用自身的db去autoexcute
	}
}