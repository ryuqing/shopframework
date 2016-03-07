<?php 
/*
作用：记录信息到日志
思路：给定内容，写入文件（fopen,fwrite...）
如果文件大于1M，重新写一份
*/
class Log{
	const LOGFILE='log';//建一个常量代表日志文件的名称
	//写日志方法
	public static function write($cont){
		$cont .="\r\n";//追加换行==  .=是什么写法？？
		//判读是否备份
		$log=self::isBak();//计算出备份文件的地址
		$fh=fopen($log, 'ab');
		fwrite($fh,$cont);
		fclose($fh);

	}
	//备份日志
	public static function bak(){
		//把文件改成年月日.bak;
		$log=ROOT.'data/log/curr.log';
		$bak=ROOT.'data/log/'.date('ymd').mt_rand(1000,9999).'.bak';
		return rename($log,$bak);

	}
	//读取并判断日志的大小
	public static function isBak(){
		//首先要判断文件存不存在
		$log=ROOT.'data/log/curr.log';
		if(!file_exists($log)){  //如果文件不存在则创建改文件
			touch($log);   //touch在linux也有次命令，是快速得建立一个文件
			return $log;
		}
		//要是存在判断大小
		$size =filesize($log);
		if($size<=1024*1024){
			return $log;
		}
		//到这行说明大于1M,我们把旧的备份，
		if(!self::bak()){    //备份失败，往旧的里面写吧还是
			return $log;
		}else{                 //备份成功，旧的不存在，新建目录
			touch($log);
			return $log;
		}

	}
}
?>