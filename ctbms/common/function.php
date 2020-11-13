<?php
require 'common/config.php';
/**
 * 重定向并停止脚本
 * @param string $url 目标地址
 */
function redirect($url)
{
    header("Location: $url");
    exit();
}

/**
 * @return mixed 数据库连接对象
 * @throws Exception
 */
function db_connect()
{
    $result = new mysqli(HOST,USERNAME,PASSWORD,DBNAME);
    $result->query('set names utf8');
    if (mysqli_connect_errno()){
        printf("连接数据库失败！: %s\n",mysqli_connect_errno());
        exit();
    }else{
        return $result;
    }
}

/**
 * 表单字符串处理
 * @param string $data 传入的接收值
 * @return string
 */

function text_input($data)
{
    $data = trim($data);  //去除首尾空格
    $data = stripcslashes($data); //去除转义发反斜线
    $data = htmlspecialchars($data);  //转义预定义HTML字符“<"与”>“
    return $data;
}

/**
 * @return int 返回累加的值
 */
function getConNumber()
{
    /*通过判断当前日期是否与文件中相同，来确定是不是同一天，是就将文件的序号累加;
     *不是将变量重新置1，并更新文件的日期;
     *文件初始化的数字为0
     */
    $fp = fopen("connumber.txt","r") or die("Unable to open file!");
    $date = fgets($fp);
    $ext = explode(',',$date);
    $count = end($ext);
    $today =prev($ext);
    fclose($fp);
    if ($today !== trim(date('Y/m/d',time())))
    {
        $file= fopen("connumber.txt","w");
        $count = 1;
        $str = trim(date('Y/m/d',time())).",".$count;
        fputs($file,$str);
        fclose($file);
        return $count;
    }else{
        $file= fopen("connumber.txt","w");
        $count = $count+1;
        $str = trim(date('Y/m/d',time())).",".$count;
        fputs($file,$str);
        fclose($file);
        return $count;
    }

}

/**
 * @param string author 排序前的作者
 * @return string 排序后的作者
 */
function sortAuthor($author)
{
    $authors = explode('-',$author);
    sort($authors);
    $count = 1;
    $str= '';
    foreach ($authors as $v){
        $str .= $count.".".$v;
        $count++;
    }
    return $str;
}
