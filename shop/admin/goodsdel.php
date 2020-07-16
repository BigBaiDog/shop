<?php
// 删除商品操作
require_once '../config.php';
if (empty($_GET['g_id'])) {
    header('Location:goods.php?act=list');
} else {
    $g_id=$_GET['g_id'];
    $sql="DELETE FROM `goods` WHERE `goods`.`g_id` = $g_id";
    $result=mysqli_query($con, $sql);
    $row=mysqli_affected_rows($con);
    $filename='../img/goods/'.$g_id.'.jpg';
	if(file_exists($filename)){
		unlink($filename);
	}
    if ($result&&$row>0) {
        echo '删除成功';
    } else {
        echo '删除失败';
    }
    header('Refresh:1;url=goods.php?act=list');
}
