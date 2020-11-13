<?php
require 'common/init.php';

//销毁用户session
session_destroy();
echo "<script>alert('您已退出登录！');window.location.href='login.php'</script>";
