<?php
// 展示商品列表操作
$sql="SELECT * FROM `goods` order by g_id desc"; // 用倒序查询商品表
$size=10; //每页大小
if (empty($_GET['page'])) {
    $page=1;
} else {
    $page=$_GET['page'];
}
if ($result=mysqli_query($con, $sql)) {
    $count=mysqli_num_rows($result);
    $total=ceil($count/$size);
} else {
    $total= 0; //总页数
}
$sql1=$sql." LIMIT ".(($page-1)*$size).", ".$size;
$result1=mysqli_query($con, $sql1);
$data=array();
while ($row=mysqli_fetch_assoc($result1)) {
    $data[]=$row;
}
