<?php
// 上传用户头像操作
session_start();
$u_id=$_SESSION["u_id"];
if (!empty($_FILES['avatar']['tmp_name'])) {
    $avatar=$_FILES['avatar'];
    if ($avatar['error'] >0) {
        echo'上传错误:';
    }
    //获取上传文件的类型
    $type = substr(strrchr($avatar['name'], '.'), 1);
    //判断上传文件类型
    if ($type !== 'jpg') {
        echo '图像类型不符合要求，请上传jpg类型的图像';
        header("Refresh:1;url=mydata.php");
    } else {
        list($width, $height) = getimagesize($avatar['tmp_name']);
        $maxwidth = $maxheight= 100;
        //自动计算缩略图的宽和高
        if ($width > $height) {
            $newwidth = $maxwidth;
            $newheight = round($newwidth*$height/$width);
        } else {
            $newheight = $maxheight;
            $newwidth = round($newheight*$width/$height);
        }
        $thumb = imageCreateTrueColor($newwidth, $newheight);
        $source = imagecreatefromjpeg($avatar['tmp_name']);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        //设置缩略图保存路径
        $new_file = './img/avatar/'.$u_id.'.jpg';
        //保存缩略图到指定目录
        imagejpeg($thumb, $new_file, 100);
        echo '头像更换成功，F5刷新可看到效果';
        header("Refresh:1;url=mydata.php");
    }
} else {
    echo '请上传头像';
    header("Refresh:1;url=mydata.php");
}
