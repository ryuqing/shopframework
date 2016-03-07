<?php 
/*
这里只写单位件上传类
多文件上传作为作业自己课下扩展
*/
//define('ACC',true);
/*
上传文件功能要求：
配置允许的后缀
配置允许的大小
随机生成目录
随机生成文件名
获取文件后缀
判断文件的后缀
良好的报错的支持
*/

class UpTool{
	protected $allowExt = 'jpg,jpeg,gif,bmp,png';
	protected $maxSize =1;//1M,M为单位

	protected $errno= 0;//错误代码
	protected $error = array(
						0=>'无错',
						1=>'上传文件大小超出系统限制',
						2=>'上传文件大小超出网页表单页面',
						3=>'文件只有部分被上传',
						4=>'没有文件被上传',
						6=>'找不到临时文件夹',
						7=>'文件写入失败',
						8=>'不允许的文件后缀',
						9=>'文件大小超出类的允许范围',
						10=>'创建目录失败',
						11=>'移动失败',
		);

	//上传
	public function up($key){
		if(!isset($_FILES[$key])){
			return false;
		}
		$f = $_FILES[$key];
		//检验上传有没有成功
		if($f['error']){
			$this->errno=$f['error'];
			return false;
		}

		//检测后缀获取
		$ext = $this->getExt($f['name']);
		if(!$this->isAllowExt($ext)){
			var_dump($ext);
			echo '<br />';
			$this->errno=8;
			return false;
		}
		//检测大小
		if(!$this->isAllowSize($f['size'])){
			$this->errno = 9;
			return false;
		}
		//创建目录
		$dir = $this->mk_dir();
		if($dir == false){
			$this->errno = 10;
			return false;
		}

		//生成随机文件名
		$newname = $this->randName().'.'.$ext;

		//移动
		if(!move_uploaded_file($f['tmp_name'],$dir)){
			$this->errno = 11;
			return false;
		}
		return str_replace(ROOT,'', $dir);
	}

	public function getErr(){
		return $this->error[$this->errno];
	}

	/*
        parm string $exts 允许的后缀
    */
    public function setExt($exts) {
        $this->allowExt = $exts;
    }

    public function setSize($num) {
        $this->maxSize = $num;
    }
    /*
        parm String $file
        return String $ext 后缀
    */    
	protected function getExt($file){//获取后缀
		$tmp = explode('.', $file);
		return end($tmp);
	}

	//判断后缀,返回的是bool  这里还要考虑大小写的问题
	protected function isAllowExt($ext){

		return in_array(strtolower($ext),explode(',',strtolower($this->allowExt)));
	}

	//判断大小
	protected function isAllowSize($size){
		return $size <= $this->maxSize*1024*1024;
	}

	//按日期创建目录的方法
	protected function mk_dir(){
		$dir = ROOT.'data/'.date('Ym/d');
		if(!is_dir($dir)||mkdir($dir,0777,true)){
			return $dir;
		}else{
			return false;
		}
	}

	//生成随机文件名
	protected function randName($length = 6){
		$str = 'abcdefghijkmnopqrstuvwxyz234569';
		substr(str_shuffle($str), 0,$length);
	}


}
?>