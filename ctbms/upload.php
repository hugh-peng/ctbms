<?php
require './common/function.php';
require './common/init.php';

error_reporting(0);
header("Content-Type:text/html;charset=utf-8");
//获取需要上传的文件目录
$temp_dir = $_GET["avatar"];
$upload_dir = "./upload/" . $temp_dir;//设置文件保存目录 注意包含/
$type = array("jpg", "gif", "bmp", "jpeg", "png");//设置允许上传文件的类型
$patch = "/";//程序所在路径

//获取文件后缀名函数
function file_ext($filename)
{
    return substr(strrchr($filename, '.'), 1);
}

//生成随机文件名函数
function random($length)
{
    $hash = 'FN-';
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
    $max = strlen($chars) - 1;
    mt_srand((double)microtime() * 1000000);
    for ($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}

$a = strtolower(file_ext($_FILES['file']['name']));
//判断文件类型
if (!in_array(strtolower(file_ext($_FILES['file']['name'])), $type)) {
    $text = implode(",", $type);
    exit("ERROR");
} //生成目标文件的文件名
else {
    $filename = explode(".", $_FILES['file']['name']);
    do {
        $filename[0] = random(10); //设置随机数长度
        $name = implode(".", $filename);
        $upload_file = $upload_dir . $name;
    } while (file_exists($upload_file));

    //获取数据库连接
    try {
        $coon = db_connect();
    } catch (Exception $e) {
    }

    //更新数据库头像地址
    $user = $_SESSION['ctbms']['user'];
    $query = "UPDATE ctbms_user SET avatar = '$upload_file' WHERE username = '$user';";
    $coon->query($query);
    $coon->close();
    $_SESSION['ctbms']['avatar'] = $upload_file;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
        $arr = array("code" => 1, "msg" => "上传成功", "src" => $upload_file);
        $my_file = fopen("upload_file.txt", "w") or die("Unable to open file!");
        fwrite($my_file, $upload_file);
        fclose($my_file);
    } else {

        $arr = array("code" => 0, "msg" => "上传失败");

    }
    echo json_encode($arr);
}


