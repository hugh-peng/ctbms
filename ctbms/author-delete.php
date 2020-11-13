<?php
require './common/function.php';
require './common/init.php';
if (!isset($_SESSION['ctbms']['user']))
{
    redirect('login.php');
}
header("Content-Type: application/json;charset=utf-8");

$canum = $_POST['canum'];

//获取连接
try {
    $conn = db_connect();
} catch (Exception $e) {
}

$query = "DELETE FROM author WHERE canum = '$canum';";

$result = $conn->query($query);
if ($result){
    $arr = array("code" => 1);
}else{
    $arr = array("code" => 2);
}
echo json_encode($arr);
$conn->close();