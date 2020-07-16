<?php
// 更改商品照片操作
if (!empty($_GET['g_id'])&&!empty($_FILES['img']['tmp_name'])) {
    $g_id=$_GET['g_id'];
    $img=$_FILES['img'];
    if ($img['error'] >0) {
        echo'上传错误:';
    }
    //获取上传文件的类型
    $type = substr(strrchr($img['name'], '.'), 1);
    //判断上传文件类型
    if ($type !== 'jpg') {
        echo '图像类型不符合要求，请上传jpg类型的图像';
        header("Refresh:1;url=goods.php?act=edit&g_id=$g_id");
    } else {
        list($width, $height) = getimagesize($img['tmp_name']);
        $newwidth = $newheight= 400;
        $thumb = imageCreateTrueColor($newwidth, $newheight);
        $source = imagecreatefromjpeg($img['tmp_name']);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        //设置缩略图保存路径
        $new_file = '../img/goods/'.$g_id.'.jpg';
        //保存缩略图到指定目录
        imagejpeg($thumb, $new_file, 100);
        header("Location:goods.php?act=edit&g_id=$g_id");
    }
}
header("Refresh:1;url=goods.php?act=edit&g_id=$g_id");
