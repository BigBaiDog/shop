<?php
require_once '../config.php';
session_start();
if (!empty($_SESSION["a_name"])&&!empty($_GET['act'])) {
    $act=$_GET['act'];
    switch ($act) {
		// 添加商品
        case 'add':
        $goods['goods_name']='';
        $goods['price']='';
        $goods['size']='';
        $goods['details']='';
        require 'goodsedit.html';
        break;
        // 删除商品
        case 'del':
        require 'goodsdel.php';
        break;
        // 编辑商品
        case 'edit':
        require 'goodsshow.php';
        require 'goodsedit.html';
        break;
        // 展示商品列表
        case 'list':
        require 'goodslist.php';
        require 'goodslist.html';
        break;
        
        default:header('Location:index.php');
    }
} else {
    header('Location:index.php');
}
