<?php
// 商城主页入口操作
require_once 'config.php';
session_start();
if (empty($_GET['key'])) {
    $sql="SELECT * FROM `goods` order by g_id desc";
} else {
	// 搜索关键词操作
    $key=$_GET['key'];
    $sql="SELECT * FROM `goods` where goods_name like '%$key%' order by g_id desc";
}
$result=mysqli_query($con, $sql);
$data=array();
while ($row=mysqli_fetch_assoc($result)) {
    $data[]=$row;
}
require 'header.html';
require 'banner.html';
require 'goodslist.html';
require 'footer.html';
