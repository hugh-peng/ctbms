<?php
/**
 * @author feng
 * @time 2020/07/11
 */

require 'common/function.php';
require 'common/init.php';
header("Content-Type:text/html;charset=utf-8");
if (!isset($_SESSION['ctbms']['user']))
{
    redirect('login.php');
}

//获取数据库连接
try {
    $coon = db_connect();
} catch (Exception $e) {
}
//先检测稿件名是否重复
$cname = text_input($_POST['cname']);
$check = "SELECT cname FROM ctbms_contribute WHERE cname ='$cname';";
$r = $coon->query($check);
if ($r->num_rows >0 ){
    echo "<script>alert('上传失败，稿件名称已存在,请重新命名！');window.location.href='contribute-add.html';</script>";
    exit("NAME REPEAT!");
}
$r->close();


//稿件允许的格式
$allow = array('docx','doc','pdf','txt');
//稿件允许的大小
$allowSize = 2000*1024;
//分割出文件类型来判断
$ext = explode('.',$_FILES['con']['name']);
$extend = end($ext);

//检测系统中是否存在指定文件夹
if (!is_dir("uploadfiles")){
    mkdir("uploadfiles");
}

//定义存放位置
$target = "uploadfiles/".$_FILES["con"]["name"];

//检验文件类型、大小是否合法
if ($_FILES['con']['size'] <= $allowSize)
{
    if (in_array($extend,$allow)){
        if (move_uploaded_file($_FILES['con']['tmp_name'],$target)){
            echo "<script>alert('文件上传成功！');window.location.href='contribute-add.html';</script>";
        }else{
            echo "<script>alert('文件上传失败,请注意文件命名');window.location.href='contribute-add.html';</script>";
            exit("ERROR!");
        }
    }else{
        echo "<script>alert('文件上传失败，请上传合法文件(docx、doc、pdf、txt)');window.location.href='contribute-add.html';</script>";
        exit("ERROR!");
    }
}else{
    echo "<script>alert('文件上传失败，请上传小于2M的文件');window.location.href='contribute-add.html';</script>";
    exit("ERROR!");
}

//接收表单的值
$cauthor = text_input($_POST['cauthor']);
$caunum = text_input($_POST['caunum']);
$cpauthor = text_input($_POST['cpauthor']);
$class = text_input($_POST['class']);
$ckey = text_input($_POST['ckey']);
$chinese = text_input($_POST['chinese']);
$english = text_input($_POST['english']);
$spon = text_input($_POST['spon']);
$con = $target;

/*稿件编号*/
$connum =$class."-".date('Y/m/d',time())."-".getConNumber();

/*将数据插入数据库*/

$query = "INSERT INTO ctbms_contribute(cname,cauthor,caunum,cpauthor,classnum,ckey,chinese,english,spon,con,connum) 
VALUES ('$cname','$cauthor','$caunum','$cpauthor','$class','$ckey','$chinese','$english','$spon','$con','$connum');";

$result = $coon->query($query);
if ($result !== TRUE){
    echo "插入数据失败！";
    exit("Error");
}
$coon->close();