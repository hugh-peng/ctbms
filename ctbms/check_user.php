<?php
header("Content-type: text/html; charset=UTF-8");
require 'common/function.php';
require 'common/init.php';

//获取数据库连接
try {
    $conn = db_connect();
} catch (Exception $e) {
    echo $e;
}


$email = text_input($_POST['Email']);
$password = text_input($_POST['Password']);
$query = "SELECT * FROM ctbms_user WHERE email = '$email';";
$result = $conn->query($query);

$row = mysqli_num_rows($result);
if (!$row){
    echo "<script>alert('邮箱或密码错误！请重新确认');window.location.href='login.php';</script>";

}else{
    while ($rows = $result->fetch_assoc()) {
        if ($rows['password'] != md5(md5($password).$rows['salt'] )){
            echo "<script>alert('邮箱或密码错误！请重新确认');window.location.href='login.php';</script>";
        }else{
            //为用户开启session
            $_SESSION['ctbms']['user'] = $rows['username'];
            $_SESSION['ctbms']['avatar'] = $rows['avatar'];
            $name = $rows['username'];
            echo "<script>alert('登录成功！欢迎您'+'$name');window.location.href='index.php';</script>";
        }
    }
}

$result->close();

//如果选择记住密码
if (!isset($_POST['remember'])){
    //设置Cookie有效时间为1天
    $pwd = $_POST['Password'];
    setcookie('pwd',$pwd,time()+86400);
}

