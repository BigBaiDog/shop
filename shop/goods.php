<?php
require_once 'config.php';
session_start();
if (!empty($_GET['act'])&&!empty($_GET['g_id'])) {
    $act=$_GET['act'];
    switch ($act) {
        // 展示商品信息操作
        case 'show':
        $g_id=$_GET['g_id'];
        $sql="SELECT * FROM `goods` WHERE `g_id` = $g_id";
        $result=mysqli_query($con, $sql);
        $goods=mysqli_fetch_assoc($result);
        if (empty($goods)) {
            header('Location:index.php');
        } else {
            require 'header.html';
            require 'goodsshow.html';
            require 'footer.html';
        }
        break;
        // 买商品操作
        case 'buy':
        if (empty($_SESSION["u_id"])) {
            echo '请登录用户';
            header("Refresh:1;url=index.php");
        } else {
            $u_id=$_SESSION["u_id"];
            $g_id=$_GET['g_id'];
            $number=1;
            $state=0;
            $sql="INSERT INTO `goodsorder` (`o_id`, `g_id`, `u_id`, `number`, `add_time`, `state`) VALUES (NULL, '$g_id', '$u_id', $number, now(), $state)";
            $result=mysqli_query($con, $sql);
            if ($result) {
                echo '下单成功';
                header('Refresh:1;url=user.php');
            } else {
                echo '下单失败';
                header("Refresh:1;url=goods.php?act=show&g_id=$g_id");
            }
        }
        break;
        
        default:header('Location:index.php');
    }
} else {
    header('Location:index.php');
}
