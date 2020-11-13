<?php
require 'common/function.php';
require 'common/init.php';


//$h = text_input($_POST['choose']);
//echo $h;
/*
$str = "你好吗mm我很好";
echo mb_substr($str,0 ,3,'utf-8');
*/
//for ($i = 0; $i <10; $i ++)
//{
//    echo getConNumber();
//}

/*
$fp = fopen("connumber.txt","r") or die("Unable to open file!");
$date = fgets($fp);
$ext = explode(',',$date);
$count = end($ext);
$today =prev($ext);
if ($today !== trim(date('Y/m/d',time())))
{
    $count = 1;
    $str = trim(date('Y/m/d',time())).",".$count;
    fputs($fp,$str);
    echo '你好';
}else{
    $file= fopen("connumber.txt","w");
    $count = $count+1;
    $str = trim(date('Y/m/d',time())).",".$count;
    fputs($file,$str);
    echo "123";
}
*/

