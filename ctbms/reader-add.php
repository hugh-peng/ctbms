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
} catch (Exception $e) {}

//先检测邮箱是否重复
$remail = text_input($_POST['remail']);
$check = "SELECT * FROM reader WHERE remail ='$remail';";
$r = $conn->query($check);
if ($r->num_rows >0 ){
    echo "<script>alert('添加失败，邮箱重复！');window.location.href='reader-add.html';</script>";
    exit("AUTHOR REPEAT!");
}
$r->close();

//接收表单的值
$rname = text_input($_POST['rname']);
$redu = text_input($_POST['redu']);
$rjobtitle = text_input($_POST['rjobtitle']);
$runit = text_input($_POST['runit']);
$rphone = text_input($_POST['rphone']);
$rfield = text_input($_POST['rfield']);
$rsocial = text_input($_POST['rsocial']);
$rcard = text_input($_POST['rcard']);

//插入数据库
$query = "INSERT INTO reader(rname,redu,rjobtitle,runit,rphone,remail,rfield,rsocial,rcard)
VALUES ('$rname','$redu','$rjobtitle','$runit','$rphone','$remail','$rfield','$rsocial','$rcard');";

$result = $conn->query($query);
if ($result !== TRUE){
    echo "插入数据失败！";
    exit("Error");
}else{
    echo "<script>alert('添加成功！');window.location.href='reader-add.html';</script>";
}
$conn->close();
