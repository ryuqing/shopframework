<?php 
/****
配置文件读取类/操作类
****/
 header("Content-type: text/html; charset=utf-8"); 
//读取配置文件类......................
class conf{
	protected static $ins=null;
	protected $data=array();
	final protected function __construct(){
    	 	//一次性把配置文件信息读过来，赋给data属性
    	 	//这样以后就不用管配置文件了。
    	 	//再要配置的值是，直接从data属性找；
             	include(ROOT.'include/config.inc.php');
             	$this->data=$CFG;
	}
     	final protected function __clone(){
     }
    	 public static function getIns(){
    	 	if(self::$ins instanceof self){
     			return self::$ins;
     		}else{
     			self::$ins=new self();
     			return self::$ins;
     	}
     }
     //用魔术方法__get读取data内的信息
     public function __get($key) {
     	if (array_key_exists($key,$this->data)) {
     		return $this->data[$key];
     	}else{
     		return null;
     	}
     }
     //用魔术方法在运行期动态增加或改变配置选项
     public function __set($key,$value){
     	$this->data[$key]=$value;
     }
}


$conf=conf::getIns();


?>