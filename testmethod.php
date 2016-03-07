<?php
header("Content-type:text/html;charset=utf-8");
Class Person{
    // 定义静态成员属性
    public $country = "中国";
    public $ha ='zhongguo';
    // 定义静态成员方法
    public static function myCountry() {
        // 内部访问静态成员属性
        echo "我是".self::$country."人<br />";
    }
       public function test2(){
    	echo 'it is work ';
    }
}
class Student extends Person {
    function study() {
        echo "我是". parent::$country."人<br />";
    }
}

echo Person::test2();

echo Person::$ha;

?>