<?php
header("Content-type:text/html;charset=utf-8");
/***
=====笔记部分=======

文件内容的读取与写入
1：要求：把a.txt的内容读出来，赋给$str变量
file_get_contents()可以获取一个文件的内容或一个网络资源的内容
file_get_contents() 是读文件/读网络比较快捷的一个函数，，
所以如果以后碰到上百M的大文件，谨慎使用此函数。
文件操作函数：
2：fopen[r,w,a]模式
     fwrite
     fclose
3：用文件操作函数，来批量处理客户名单
第一种方法 一种暴力方法file_get_contents获取内容,再用explode("r\n",$cont)
再用\r \n切成数组
注意：但各种操作系统下，换行符并不一致
win:\r\n
*unx:\n
mac:\r
第二种方法，打开，一点点的读每次读一行
fgets()每次读一行
//模式里面可以加个rb表示以二进制来处理，这样不受编码干扰会比较好fopen($file,'rb');
但是这样要一个一个读
所以当文件指针往后移动的时候
feof,end of file的意思  专门来判断文件是否已经走到了结尾

第三种方法，也是一种比较暴力的方法 file（$file）file函数直接，读取文件内容，并按行拆成数组，返回该数组
他和file_get_contents一样也是一次性读取所有页面，占资源，慎用。
**/

$url='./a.txt';
$str=file_get_contents($url);

//读出来的内容可不可以写到另一个文件中去呢？
//file_put_contents(filename, data) 这个函数用来把内容写入到文件 也是一个快捷函数，帮我们封装打开写入关闭细节。
file_put_contents('./b.txt',$str);


//最简单的小偷程序，，，
$url ='http://www.sina.com.cn/';
$html=file_get_contents('./b.txt',$url);
if(file_put_contents('./sina.htm', $html)){
	echo '偷过来了';
}else{
	echo '偷不到，气死你';
}
//fopen 是打开一个文件，返回一个句柄资源 
//fopen(filename, mode) 
//第二个参数“模式” 如是只读模式如通道模式如读写模式如追加模式

/*
w:写入模式（fread读不了）
并把文件截为零（文件被清空），指针停于开头处
*/
/*
w:追加模式 打开模式（能写并把指针停在最后)
*/

?>