<?php
require 'config.php';
session_start();
if (empty($_SESSION['u_id'])) {
    header('Location:index.php');
} else {
	// 更改用户信息操作
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $u_id=$_SESSION['u_id'];
        $u_name=$_POST['u_name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $sql1="SELECT * FROM `user` WHERE `u_name` = '$u_name' and `u_id` != $u_id";
        $result1=mysqli_query($con, $sql1);
        $rowcount=mysqli_num_rows($result1);
        if ($rowcount>0) {
            echo '该用户名已存在';
        } else {
            $sql2="UPDATE `user` SET `u_name` = '$u_name', `email` = '$email' , `phone` = '$phone', `address` = '$address' WHERE `user`.`u_id` = $u_id";
            $result2=mysqli_query($con, $sql2);
            if ($result2) {
                echo '修改成功';
            } else {
                echo '修改失败';
            }
        }
        header("Refresh:1;url=mydata.php");
    } else {
        $u_id=$_SESSION['u_id'];
        $sql = "SELECT *  FROM `user` WHERE `u_id` = $u_id";
        $result=mysqli_query($con, $sql);
        $data=mysqli_fetch_assoc($result);
        require 'mydata.html';
    }
}
