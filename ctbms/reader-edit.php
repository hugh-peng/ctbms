<?php
require './common/function.php';
require './common/init.php';
if (!isset($_SESSION['ctbms']['user']))
{
    redirect('login.php');
}
//获取表单的值
$remail = text_input($_POST['remail']);
$choose = text_input($_POST['choose']);
$new = text_input($_POST['new']);

//获取连接
try {
    $conn = db_connect();
} catch (Exception $e) {
}

//拼接更新语句
$query = "UPDATE reader SET ".$choose." = '$new' WHERE remail = '$remail';";
$result = $conn->query($query);
if ($result){
    echo "<script>alert('修改成功！');window.location.href='reader-edit.html';</script>";
}else{
    echo "<script>alert('修改失败！');window.location.href='reader-edit.html';</script>";
    exit("COMMIT FAIL");
}
$conn->close();
