<?php
require_once '../config.php';
session_start();
if (!empty($_SESSION["a_name"])&&!empty($_GET['act'])) {
    $act=$_GET['act'];
    switch ($act) {
		// 展示订单列表操作
        case 'list':
        $sql="SELECT * FROM `goodsorder` JOIN `goods` ON `goodsorder`.`g_id`=`goods`.`g_id` JOIN `user` ON `goodsorder`.`u_id`=`user`.`u_id` order by o_id desc";
        $size=10;
        if (empty($_GET['page'])) {
            $page=1;
        } else {
            $page=$_GET['page'];
        }
        if ($result=mysqli_query($con, $sql)) {
            $count=mysqli_num_rows($result);
            $total=ceil($count/$size);
        } else {
            $total= 0;
        }
        $sql1=$sql." LIMIT ".(($page-1)*$size).", ".$size;
        $result1=mysqli_query($con, $sql1);
        $data=array();
        while ($row=mysqli_fetch_assoc($result1)) {
            $data[]=$row;
        }
        require 'orderlist.html';
        break;
		// 展示订单信息操作
        case 'show':
        if (empty($_GET['o_id'])) {
            header('Location:order.php?act=list');
        } else {
            $o_id=$_GET['o_id'];
            $sql="SELECT * FROM `goodsorder` JOIN `goods` ON `goodsorder`.`g_id`=`goods`.`g_id` JOIN `user` ON `goodsorder`.`u_id`=`user`.`u_id` WHERE `goodsorder`.`o_id` = $o_id";
            $result=mysqli_query($con, $sql);
            $data=mysqli_fetch_assoc($result);
            require 'ordershow.html';
        }
        break;
        // 完成订单操作
        case 'finish':
        $o_id=$_GET['o_id'];
        $sql="UPDATE `goodsorder` SET `state` = '1' WHERE `goodsorder`.`o_id` = $o_id";
        $result=mysqli_query($con, $sql);
        echo '订单完成';
        header("Refresh:1;url=order.php?act=show&o_id=$o_id");
        break;
        // 取消订单操作
        case 'cancel':
        $o_id=$_GET['o_id'];
        $sql="UPDATE `goodsorder` SET `state` = '-1' WHERE `goodsorder`.`o_id` = $o_id";
        $result=mysqli_query($con, $sql);
        echo '订单取消';
        header("Refresh:1;url=order.php?act=show&o_id=$o_id");
        break;

        default:header('Location:index.php');
    }
} else {
    header('Location:index.php');
}
