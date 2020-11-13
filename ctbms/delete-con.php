<?php
require './common/function.php';
require './common/init.php';
if (!isset($_SESSION['ctbms']['user']))
{
    redirect('login.php');
}
header("Content-Type: application/json;charset=utf-8");

$cname = text_input($_POST['cname']);

//获取连接
try {
    $conn = db_connect();
} catch (Exception $e) {
}
$query = "SELECT con FROM ctbms_contribute WHERE cname = '$cname';";
$result = $conn->query($query);
$address ='';  //查要删文件位置
if ($result){
    while ($row = $result->fetch_row()){
        $address = $row[0];
    }
}
$result->close();
/*先删除本地文件，再操作数据库*/
if (unlink($address)){
    //删除文件成功了，再操作数据库
    $delete = "DELETE FROM ctbms_contribute WHERE cname = '$cname';";
    $conn->query($delete);
    $arr = array("code" => 1, "msg" => $cname);
}else{
    $arr = array("code" => 2, "msg" => $cname);
}

echo json_encode($arr);
$conn->close();
