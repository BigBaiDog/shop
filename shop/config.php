<?php
// 配置数据库文件
define('host','localhost');
define('username','root');
define('password','');
define('dbname','shop');
define('port','');
$con=mysqli_connect(host,username,password,dbname);
if(!$con){
	die("连接数据库失败：".mysqli_connect_error());
}
mysqli_set_charset($con,"utf8");