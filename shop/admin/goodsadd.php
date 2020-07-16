<?php
// 添加商品操作
require_once '../config.php';
$goods_name=$_POST['goods_name'];
$price=$_POST['price'];
$size=$_POST['size'];
$details=$_POST['details'];
$sql="INSERT INTO `goods` (`g_id`, `goods_name`, `price`, `size`, `details`) VALUES (NULL, '$goods_name', '$price', '$size', '$details')";
$result=mysqli_query($con,$sql);
if($result){
	echo '添加成功';
	header('Refresh:1;url=goods.php?act=list');
}
else{
	echo '添加失败';
	header('Refresh:1;url=goods.php?act=add');
}
?>