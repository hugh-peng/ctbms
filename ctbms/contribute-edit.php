<?php
require './common/function.php';
require './common/init.php';
if (!isset($_SESSION['ctbms']['user']))
{
    redirect('login.php');
}

//获取表单数据
$cname = text_input($_POST['cname']);
$choose = text_input($_POST['choose']);
$new = text_input($_POST['new']);
$newt = text_input($_POST['newt']);

//获取连接
try {
    $conn = db_connect();
} catch (Exception $e) {
}

//判断是不是修改摘要
if ($choose == "chinese" || $choose == "english")
{
    if (empty($newt)){
        echo "<script>alert('新摘要内容为空！请重新输入');window.location.href='contribute-edit.html';</script>";
        exit("ABSTRACT IS NULL");
    }else{
        //拼接更新语句
        $query = "UPDATE ctbms_contribute SET ". $choose." = '$newt' WHERE cname = '$cname';";
        $result = $conn->query($query);
        if ($result){
            echo "<script>alert('修改成功！');window.location.href='contribute-edit.html';</script>";
        }else{
            echo "<script>alert('修改失败，稿件名称不存在！');window.location.href='contribute-edit.html';</script>";
            exit("CNAME IS NOT EXIT");
        }
        $conn->close();
    }
}else{
    if (empty($new)){
        echo "<script>alert('修改内容为空！请重新输入');window.location.href='contribute-edit.html';</script>";
        exit("NEW IS NULL");
    }else{
        $query = "UPDATE ctbms_contribute SET ". $choose." = '$new' WHERE cname = '$cname';";
        $result = $conn->query($query);
        if ($result){
            echo "<script>alert('修改成功！');window.location.href='contribute-edit.html';</script>";
        }else{
            echo "<script>alert('修改失败，稿件名称不存在！');window.location.href='contribute-edit.html';</script>";
            exit("CNAME IS NOT EXIT");
        }
        $conn->close();

    }

}
