<?php
// 编辑商品操作
require_once '../config.php';
$g_id=$_POST['g_id'];
$goods_name=$_POST['goods_name'];
$price=$_POST['price'];
$size=$_POST['size'];
$details=$_POST['details'];
// 更改数据库各项信息
$sql="UPDATE `goods` SET `goods_name` = '$goods_name', `price` = '$price', `size` = '$size', `details` = '$details' WHERE `goods`.`g_id` = $g_id";
$result=mysqli_query($con, $sql);
if ($result) {
    echo '修改成功';
    header('Refresh:1;url=goods.php?act=list');
} else {
    echo '修改失败';
    header('Refresh:1;url=goods.php?act=edit');
}
