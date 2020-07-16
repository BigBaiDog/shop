<?php
// 管理员入口跳转
session_start();
if (empty($_SESSION["a_name"])) {
    require 'admin.html';
} else {
    require 'index.html';
	require '../footer.html';
}
