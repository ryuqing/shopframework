<?php 
 header("Content-type: text/html; charset=utf-8"); 
/****
什么是抽象方法?我们在类里面定义的只有方法名没有方法体的方法就是抽象方法，所谓没有方法体就是在方法声明的时候没有
大括号以及其中的内容，而是直接声明时在方法名后加上分号结束，另外在声明抽象方法时还要加一个关键字"abstract"来修饰。
:1：用abstract修饰的类表示这个类是一个抽象类，这个抽象类不能直接被实例化，否则系统会报错。

2：抽象类不能被直接被实例化，可以继承重写方法然后实例化；并且如果继承类不是抽象类，必须重写抽象方法
抽象类继承另外一个抽象类时，不用重写其中的抽象方法也不能重写其中的方法，那这样你就不禁会问 要这个子抽象类干什么啊？
抽象类继承抽象类，目的对抽象类的扩展。

3：一个类中，如果有一个抽象方法，这个类必须被声明为抽象类。
****/
class msql extends db{
	private static $ins=NULL;
	private $conn=NULL;
	private $conf=array();
	protected $log=NULL;
	protected function __construct(){
		$this->log=new Log();
		$this->conf=conf::getIns();
		$this->connect($this->conf->host,$this->conf->user,$this->conf->password);
		$this->switchDb($this->conf->db);
		$this->setChar($this->conf->char);
	}
	public function __destruct(){

	}

	public static function getIns(){
		if(!(self::$ins instanceof self)){
			self::$ins=new self();
		}
		return self::$ins;
	}	
	public function connect($h,$u,$p){
		$this->conn=mysql_connect($h,$u,$p);
		if(!$this->conn){
			$err=new Exception('连接失败');
			throw $err;
		}
	}
	//选库
	protected function switchDb($db){
		$sql='use '.$db;
		$this->query($sql);

	}
	//设置字符编码
	public function setChar($char){
		$sql='set names  '.$char;
		$this->query($sql);
	}
	//发送查询 *********注意这样写少了日志功能**************
		/***********************public function query($sql){
		$rs=mysql_query($sql,$this->conn);
		return $rs;
	}
这个是18哥写的无法调试	*******************************/
	public function query($sql){
		/*if($this->conf->debug){
			$this->log->write($sql);
		}   **/
		$rs=mysql_query($sql,$this->conn);
		//if(!$rs){  }
			$this->log->write($sql);
		
		return $rs;
	}

	public function autoEXecute($arr,$table,$mode='insert',$where='where 1 limit 1'){
		if(!is_array($arr)){
			return false;
		}
		if($mode=='update'){
			$sql='update '. $table .' set ';
			foreach ($arr as $k => $v) {
				$sql .=$k ."='".$v."' ,";
			}
			$sql=rtrim($sql,',');
			$sql .=$where;
			return $this->query($sql);
		}
		$sql='insert into '.$table . '(' . implode(',' ,array_keys($arr)) .')';
		$sql .=' values (\'';
		$sql .=implode("','", array_values($arr));
		$sql .='\')';
		return $this->query($sql);
	}

	//查询多行数据
	public function getAll($sql){
		$rs=$this->query($sql);
		$list=array();
		while ($row=mysql_fetch_assoc($rs)){
			$list[]=$row;	
		}
		return $list;
	}
	//查询单行数据
	public function getRow($sql){
		$rs=$this->query($sql);
		return mysql_fetch_assoc($rs);

	}
	//查询单个数据 
	public function getOne($sql){
		$rs=$this->query($sql);
		$row=mysql_fetch_row($rs);
		return $row[0];
	}
	//返回影响行数的函数
	public function affected_rows(){
		return mysql_affected_rows($this->conn);
	}
	//返回最新的auto_increment列的自增长值
	public function insert_id(){
		return mysql_insert_id($this->conn);
	}

}

?>