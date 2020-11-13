<?php
require 'common/function.php';
require 'common/init.php';
header("Content-Type:text/html;charset=utf-8");
if (!isset($_SESSION['ctbms']['user']))
{
    redirect('login.php');
}

//获取数据库连接
try {
    $conn = db_connect();
} catch (Exception $e) {
}
//先检测作者编号是否重复
$canum = text_input($_POST['canum']);
$check = "SELECT * FROM author WHERE canum ='$canum';";
$r = $conn->query($check);
if ($r->num_rows >0 ){
    echo "<script>alert('添加失败，作者已存在！');window.location.href='author-add.html';</script>";
    exit("AUTHOR REPEAT!");
}
$r->close();

//接收表单的值
$aname = text_input($_POST['aname']);
$aedu = text_input($_POST['aedu']);
$ajobtitle = text_input($_POST['ajobtitle']);
$aunit = text_input($_POST['aunit']);
$aphone = text_input($_POST['aphone']);
$aemail = text_input($_POST['aemail']);
$afield = text_input($_POST['afield']);

//插入数据库
$query = "INSERT INTO author(canum,aname,aedu,ajobtitle,aunit,aphone,aemail,afield)
VALUES ('$canum','$aname','$aedu','$ajobtitle','$aunit','$aphone','$aemail','$afield');";

$result = $conn->query($query);
if ($result !== TRUE){
    echo "插入数据失败！";
    exit("Error");
}else{
    echo "<script>alert('添加成功！');window.location.href='author-add.html';</script>";
}
$conn->close();