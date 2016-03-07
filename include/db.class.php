<?php 
/****
可以使用abstract来修饰一个类。

用abstract修饰的类表示这个类是一个抽象类。

抽象类不能被实例化。

这是一个简单抽象的方法，如果它被直接实例化，系统会报错。
什么是抽象方法?我们在类里面定义的只有方法名没有方法体的方法就是抽象方法，所谓没有方法体就是在方法声明的时候没有
大括号以及其中的内容，而是直接声明时在方法名后加上分号结束，另外在声明抽象方法时还要加一个关键字"abstract"来修饰。


****/
 header("Content-type: text/html; charset=utf-8"); 
abstract class db{ 
	//连接服务器
	public abstract function connect($h,$u,$p);
	/*发送查询
	return mixed bool/resource
	*/
	public abstract function query($sql);
	//查询多行数据 return array/bool
	public abstract function getAll($sql);
	//查单行数据
	public abstract function getRow($sql);
	
	//查单个数据parms $sql select 型语句
	public abstract function getOne($sql);

	/*自动执行insert/update 语句
	parms $sql select 型语句
	return a='insert'
	autoEXecuate('user',array('username'=>'zhangsan'),'email'=>'zhang@163.com'),insert)
	*/
	public abstract function autoEXecute($table,$data,$act,$where);
}
?>