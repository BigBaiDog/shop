<?php
require_once 'config.php';
session_start();
// 验证登录状态
if (empty($_GET['act'])) {
    if (empty($_SESSION['u_id'])) {
        echo '请登录用户';
        header("Refresh:1;url=index.php");
    } else {
        require 'header.html';
        require 'user.html';
        require 'footer.html';
    }
} else {
    $act=$_GET['act'];
    switch ($act) {
        // 注册用户操作
        case 'register':
        // 格式验证
        $u_name=$_POST['u_name'];
        if (!preg_match('/^[\w\x{4e00}-\x{9fa5}]{2,10}$/u', $u_name)) {
            echo '用户名格式不符合要求';
            header('Refresh:1;url=index.php');
        }
        $u_password=$_POST['u_password'];
        if (!preg_match('/^\w{6,16}$/', $u_password)) {
            echo '密码格式不符合要求';
            header('Refresh:1;url=index.php');
        }
        // 密码加密
        $u_password=md5($u_password);
        $sql="SELECT * FROM `user` WHERE `u_name` = '$u_name'";
        $result=mysqli_query($con, $sql);
        if (mysqli_num_rows($result)==0) {
            $sql1="INSERT INTO `user` (`u_id`, `u_name`, `u_password`, `email`, `phone`, `address`) VALUES (NULL, '$u_name', '$u_password', '', '', '')";
            $result1=mysqli_query($con, $sql1);
            if ($result1) {
                echo '注册成功';
            } else {
                echo '注册失败';
            }
            header('Refresh:1;url=index.php');
        } else {
            echo '该用户名已存在';
            header('Refresh:1;url=index.php');
        }
        break;
        // 用户登录操作
        case 'signin':
        $u_name=$_POST['u_name'];
        $u_password=$_POST['u_password'];
        $u_password=md5($u_password);
        $sql="SELECT * FROM `user` WHERE `u_name` = '$u_name'";
        $result=mysqli_query($con, $sql);
        if (mysqli_num_rows($result)) {
            $row=mysqli_fetch_assoc($result);
            if ($u_password==$row['u_password']) {
                $_SESSION['u_id']=$row['u_id'];
                $_SESSION['u_name'] = $u_name;
                header('Location:index.php');
            } else {
                echo '密码错误';
                header('Refresh:1;url=index.php');
            }
        } else {
            echo '该用户不存在';
            header('Refresh:1;url=index.php');
        }
        break;
        // 退出登录操作
        case 'quit':
		// 清除会话
        session_destroy();
        echo '已退出登录';
        header('Refresh:1;url=index.php');
        break;
        // 用户注销操作
        case 'cancel':
        $u_id=$_SESSION['u_id'];
        $u_password=$_POST['u_password'];
        $u_password=md5($u_password);
        $sql="SELECT * FROM `user` WHERE `u_id` = '$u_id'";
        $result=mysqli_query($con, $sql);
        $row=mysqli_fetch_assoc($result);
        if ($u_password==$row['u_password']) {
            $sql1="DELETE FROM `user` WHERE `user`.`u_id` = $u_id";
            $result1=mysqli_query($con, $sql1);
            session_destroy();
            echo '账号已注销，请F5刷新页面';
        } else {
            echo '密码错误';
            header('Refresh:1;url=safe.html');
        }
        break;
        // 用户密码更改操作
        case 'reset':
        $u_id=$_SESSION['u_id'];
        $old=$_POST['old'];
        $old=md5($old);
        $sql="SELECT * FROM `user` WHERE `u_id` = '$u_id'";
        $result=mysqli_query($con, $sql);
        $row=mysqli_fetch_assoc($result);
        if ($old==$row['u_password']) {
            $u_password=$_POST['u_password'];
            $u_password=md5($u_password);
            $sql1="UPDATE `user` SET `u_password` = '$u_password' WHERE `user`.`u_id` = $u_id";
            $result1=mysqli_query($con, $sql1);
            echo '密码已修改';
            header('Refresh:1;url=safe.html');
        } else {
            echo '密码错误';
            header('Refresh:1;url=safe.html');
        }
        break;
        
        default:header('Location:index.php');
    }
}
