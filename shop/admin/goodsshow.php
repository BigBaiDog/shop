<?php
// 展示商品信息操作
if (empty($_GET['g_id'])) {
    header('Location:goods.php?act=list');
} else {
    $g_id=$_GET['g_id'];
    $sql="SELECT * FROM `goods` WHERE `g_id` = $g_id";
    $result=mysqli_query($con, $sql);
    $goods=mysqli_fetch_assoc($result);
    if (empty($goods)) {
        header('Location:goods.php?act=list');
    }
}
