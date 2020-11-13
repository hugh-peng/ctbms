<?php
date_default_timezone_set('Asia/Shanghai');
session_set_cookie_params(0,null,null,null,true);
mb_internal_encoding('UTF-8');

session_start();
//为项目创建Session,统一保存到ctbms中
if (!isset($_SESSION['ctbms'])){
    $_SESSION = ['ctbms' => []];
}