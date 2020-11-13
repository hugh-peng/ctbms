<?php
require 'common/function.php';
require 'common/init.php';
header("Content-Type:text/html;charset=utf-8");
if (!isset($_SESSION['ctbms']['user']))
{
    redirect('login.php');
}

//获取表单的值
$cname = text_input($_POST['cname']);
$rname = text_input($_POST['rname']);
$remail = text_input($_POST['remail']);
$check = text_input($_POST['check']);

//获取数据库连接
try {
    $conn = db_connect();
} catch (Exception $e) {}

//先检测是否存在该审稿人
$query1 = "SELECT * FROM reader WHERE rname = '$rname' AND remail = '$remail';";
$r1 = $conn->query($query1);
if ($r1->num_rows <= 0)
{
    echo "<script>alert('不存在该审稿人，请仔细核对信息！');window.location.href='con-perusecheck.html';</script>";
    exit("NO THIS ONE!");
}else{
    if ($check =="录用")
    {
        echo "<script>alert('审核成功！');window.location.href='con-perusecheck.html';</script>";
        $query2 = "UPDATE ctbms_contribute SET perusenum = perusenum+1 WHERE cname = '$cname';";
        $conn->query($query2);
        $conn->close();
    }else{
        echo "<script>alert('审核完成！');window.location.href='con-perusecheck.html';</script>";
        $conn->close();
    }

}
$r1->close();