<?php 


class TestModel{
	protected $table='tshop';
	protected $db=null;
	//用户注册的方法  
	public function __construct(){
		$this->db=msql::getIns();
	}
	public function reg($data){
		return $this->db->autoEXecute($data,$this->table,'insert');

	}
	public function table($table){
		$this->table =$table;
	}
}


