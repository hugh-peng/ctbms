<?php
require './common/function.php';
require './common/init.php';
require './common/library/DataBase.php';

$Name = text_input($_POST['Name']);
$Email = text_input($_POST['Email']);
$Password = text_input($_POST['Password']);
$an = text_input($_POST['an']);

/*
$Name = text_input($_GET['Name']);
$Email = text_input($_GET['Email']);
$Password = text_input($_GET['Password']);
$an = text_input($_GET['an']);
*/
//获取数据库连接
try {
    $conn = db_connect();
} catch (Exception $e) {
    echo $e;
}



$database = new DataBase();
$query1 = $database->find('*','ctbms_user','username',$Name);
$query2 = $database->find('*','ctbms_user','email',$Email);

$result1 = $conn->query($query1);
$result2 = $conn->query($query2);
if (!$result1 || !$result2){
    echo '数据库查询失败';
}
$row1 = mysqli_num_rows($result1);
$row2 = mysqli_num_rows($result2);
if ($row1)
{
    echo "a";
}else if ($row2) {
    echo "b";
}else{
    $salt = substr(uniqid(),-5);
    $password = md5(md5($Password).$salt);
    $answer = md5(md5($an).$salt);
    $query3 = "INSERT INTO ctbms_user(username, email, password, salt, answer) VALUES ('$Name', '$Email', '$password', '$salt', '$answer');";
    $result3 = $conn->query($query3);
    if ($result3 == TRUE)
    {
        echo '恭喜！注册成功，请使用邮箱登录';
    }

}
$result1->free();
$result2->free();
$conn->close();