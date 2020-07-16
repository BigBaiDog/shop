<?php
if(!empty($_GET['act'])&&!empty($_GET['id'])){
	$act=$_GET['act'];
	$id=$_GET['id'];
	// 上传轮播图操作
	if($act=='up'&&!empty($_FILES['banner']['tmp_name'])){
		$banner=$_FILES['banner'];
		if($banner['error'] >0){
			echo'上传错误:';
		}
		//获取上传文件的类型
		$type = substr(strrchr($banner['name'],'.'),1);
		//判断上传文件类型
		if($type !== 'jpg'){
			echo '图像类型不符合要求，请上传jpg类型的图像';
			header("Refresh:1;url=bb.php");
		}else{
			$filename='../img/banner/'.$id.'.jpg';
			if(!move_uploaded_file($banner['tmp_name'],$filename)){
				echo '图片上传失败;';
				header("Refresh:1;url=bb.php");
			}
		}
	}elseif($act=='del'){
		// 删除轮播图操作
		$filename='../img/banner/'.$id.'.jpg';
		// 删除文件
		if (!unlink($filename)){
			echo '图片删除失败;';
			header("Refresh:1;url=bb.php");
		}
	}
}
require 'banner.html';