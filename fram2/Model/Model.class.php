<?php 
/****

****/
class Model{
	protected $table=NULL;
	protected $db=NULL;
	//用户注册的方法  
	public function __construct(){
		$this->db=msql::getIns();
	}
	public function table($table){
		$this->table=$table;
	}
}
