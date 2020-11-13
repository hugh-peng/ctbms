<?php
require './common/function.php';
require './common/init.php';
if (!isset($_SESSION['ctbms']['user']))
{
    redirect('login.php');
}
header("Content-Type: application/json;charset=utf-8");

$ids = text_input($_POST['ids']);

//获取连接
try {
    $conn = db_connect();
} catch (Exception $e) {
}

//处理传入的字符串
$ids = explode(",",$ids);
$str = implode("','",$ids);

$query = "DELETE FROM author WHERE canum in ('{$str}')";
$results = $conn->query($query);
if ($results){
    $arr = array("code" => 1);
}else{
    $arr = array("code" => 2);
}
echo json_encode($arr);
$conn->close();