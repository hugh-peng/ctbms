<?php
require 'common/function.php';

$email = text_input($_POST['email']);
$answer = text_input($_POST['answer']);

//获取数据库连接
try {
    $coon = db_connect();
}catch (Exception $e){
    echo $e;
}
$query = "SELECT * FROM ctbms_user WHERE email = '$email';";
$result = $coon->query($query);
$row = mysqli_num_rows($result);
if (!$row){
    echo "邮箱或密保答案错误，请重新确认！";
}else{
    while ($rows = $result->fetch_assoc()){
        if ($rows['answer'] != md5(md5($answer).$rows['salt']) ){
            echo "邮箱或密保答案错误，请重新确认！";
        }else{
            $newPassWord = substr(uniqid(),-5);
            $newPW = md5(md5($newPassWord).$rows['salt']);
            $id = $rows['id'];
            $query2 = "UPDATE ctbms_user SET password = '$newPW' WHERE id = '$id';";
            $coon->query($query2);
            echo "您的新密码是:".$newPassWord." 请妥善保管";
        }
    }
}
$result->close();
