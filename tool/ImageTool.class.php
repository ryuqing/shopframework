<?php 
/*
水印  缩略图  验证码类
水印：就是把置顶的水印复制到目标上，并加透明效果
缩略图：就是把大图片复制到小尺寸画面上
*/

class ImageTool{

	//imageinfo 分析图片信息
	//返回图片的信息
	public static function imageInfo($image){
		if(!file_exists($image)){
			return false;
		}

		//取得图片大小
		$info = getimagesize($image);
		if($info==false){
			return false;
		}
		//此时info返回的是一个数组
		$img['width']=$info['0'];
		$img['height']=$info['1'];
		$img['ext']=substr($info['mime'], strpos($info['mime'], '/')+1);

		return $img;
	}

	/*加水印功能
	parm String $dst 等操作图片
	parm String $water 水印小图
	parm String $save, 不填则默认替换原始图片
	*/
	public static function water($dst,$water,$save=null,$pos=2,$alpha=50){
		if(!file_exists($dst)||!file_exists($water)){
			return false;
		}

		//需保证复制的图片不能比待操作的图片还大
		$dinfo = self::imageInfo($dst);
		$winfo = self::imageInfo($water);
		if($winfo['width']>$dinfo['width']||$winfo['height']>$dinfo['height']){
			return false;
		}

		//现在有两张图要读到画布上，但是可能是png，也可能是jpeg，用什么函数读？
		$dfunc = 'imagecretefrom'.$dinfo['ext'];
		$wfunc = 'imagecreatefrom'.$winfo['ext'];

		if(!function_exists($dfunc)|| !function_exists($wfunc)){
			return false;
		}

		//动态加载函数创建画布（ps:这是使用原图创建画布）
		$dim = $func($dst);	//创建待操作的画布
		$wim = $wfunc($water);//创建水印画布

		//根据水印的位置 计算粘贴的坐标
		switch ($pos) {
			case '0':
				$posx=0;
				$posy=0;
				break;
			case '1':
				$posx=$dinfo['width']-$winfo['width'];
				$posy=0;
				break;
			case '2':	
				$posx=$dinfo['width']-$winfo['width'];
				$posy=$dinfo['height']-$dinfo['height'];
				break;
			default:
				$posx=0;
				$posy=$dinfo['height']-$dinfo['height'];
				break;
		}

		//现在所有参数到位了，开始加水印(其实就是复制过程罢了)
		imagecopymerge($dst, $water, $posx, $posy, 0, 0, $winfo['width'], $winfo['height'], 50);
		//保存
		if(!$save){
			$save = $dst;
			unlink($dst);//删除原图
		}

		//输出到浏览器
		$createfunc='image'.$dinfo['ext'];
		$createfunc($dim,$save);

		//销毁图片
		imagedestroy($dim);
		imagedestroy($wim);

		return true;
	}


	/*
		thumb 生成缩略图
		等比例缩放，两边留白
	*/

	public static function thumb($dst,$save=NULL,$width=200,$height=200){
		//首先判断处理的图片存不存在
		$dinfo=self::imageInfo($dst);
		if($dinfo==false){
			return false;
		}

		//计算缩放比例
		$calc = min($width/$dinfo['width'],$height/$dinfo['height']);

		//创建原始画布
		$dfunc ='imagecreatefrom'.$dinfo['ext'];
		$dim = $dfunc($dst);

		//创建缩略图画布
		$tim = imagecreatetruecolor($width,$height);

		//创建白色填充缩略图画布
		$white = imagecolorallocate($tim, 255, 255, 255);

		//填充缩略图画布
		imagefill($tim,0,0,$white);

		//复制并缩略
		$dwidth = (int)$dinfo['width']*$calc;
		$dheight =(int)$dinfo['height']*$calc;
		
		//两端各留多少白
		$paddingx = (int)($width-$dwidth)/2;
		$paddingy = (int)($height - $dheight)/2;

		imagecopyresampled($tim, $dim, $paddingx, $paddingy, 0, 0, $dwidth, $dheight, $dinfo['width'], $dinfo['height']);

		//保存图片
		if(!$save){
			$save = $dst;
			unlink($dst);//删除原图
		}

		$createfunc ='image'.$dinfo['ext'];
		$createfunc($tim,$save);

		imagedestroy($dim);
		imagedestroy($tim);

		return ture;

	}

	//写验证码

	public static function captcha($width=50,$height=25){
		//造画布
		$image= imagecreatetruecolor($width, $height);

		//造背景色
		$gray = imagecolorallocate($image, 200, 200, 200);

		//填充背景
		imagefill($image, 0, 0, $gray);

		//造随机的字体的颜色
		$color = imagecolorallocate($image, mt_rand(0,125), mt_rand(0,125), mt_rand(0,125));

		//造随机线条的颜色
		$color1=imagecolorallocate($image, mt_rand(100,125), mt_rand(100,125), mt_rand(100,125));
		$color2=imagecolorallocate($image, mt_rand(100,125), mt_rand(100,125), mt_rand(100,125));
		$color3=imagecolorallocate($image, mt_rand(100,125), mt_rand(100,125), mt_rand(100,125));

		//在画布上面画线
		imageline($image,mt_rand(0,50),mt_rand(0,25),mt_rand(0,50),mt_rand(0,50),$color1);
		imageline($image,mt_rand(0,50),mt_rand(0,25),mt_rand(0,50),mt_rand(0,50),$color2);
		imageline($image,mt_rand(0,50),mt_rand(0,25),mt_rand(0,50),mt_rand(0,50),$color3);

		//在画布上写字
		$text = substr(str_shuffle('ABCDEFGHIJKLMNPQRSTabcdefghjklmnpqrst23456789'), 0,4);
		imagestring($image, 5, 7, 5, $txt, $color);

		//显示、销毁
		header('content-type:image/jpeg');
		imagejpeg($image);
		imagedestroy($image);

	}

}











?>