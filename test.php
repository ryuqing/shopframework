<?php
$conn=mysql_connect('localhost','root','111111');
$select='use insomniac';
if(mysql_query($select,$conn)){
	echo 'Ok';
}else{
	echo 'connect fail';
}
$sql='select * from wp_users';
$row=mysql_query($sql,$conn);
print_r(mysql_fetch_row($row));






?>