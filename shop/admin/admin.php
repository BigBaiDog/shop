<?php
require_once '../config.php';
session_start();
if (empty($_GET['act'])) {
    header('Location:index.php');
} else {
    $act=$_GET['act'];
    switch ($act) {
		// 登录操作
        case 'signin':
        $a_name=$_POST['a_name'];
        $a_password=$_POST['a_password'];
        $sql="SELECT * FROM `admin` WHERE `a_name` = '$a_name'";
        $result=mysqli_query($con, $sql);
        $row=mysqli_fetch_assoc($result);
        if ($a_password==$row['a_password']) {
            $_SESSION["a_id"]=$row['a_id'];
            $_SESSION["a_name"] = $a_name;
            echo '登录成功';
            header('Location:index.php');
        } else {
            echo '登录失败';
            header('Refresh:1;url=admin.html');
        }
        break;
		// 退出登录操作
        case 'quit':
        session_destroy();
        echo '已安全退出';
        header('Refresh:1;url=../index.php');
        break;
		
        default:header('Location:index.php');
    }
}
