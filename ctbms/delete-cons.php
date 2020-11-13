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

/*先找到文件位置进行删除*/
$query = "SELECT con FROM ctbms_contribute WHERE cname in ('{$str}')";
$result = $conn->query($query);
$address ='';
if ($result){
    while ($row = $result->fetch_row()){
        $address = $row[0];
        unlink($address);   //删除本地文件
    }
}
$result->close();
//本地文件删除完成后在数据库进行delete
$delete = "DELETE FROM ctbms_contribute WHERE cname in ('{$str}')";
$results = $conn->query($delete);
if ($results){
    $arr = array("code" => 1);
}else{
    $arr = array("code" => 2);
}
echo json_encode($arr);
$conn->close();