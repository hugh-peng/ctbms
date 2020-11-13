<?php require './common/init.php';?>

<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="stylesheet" href="./css/font.css">
        <link rel="stylesheet" href="./css/xadmin.css">
        <script src="./lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="./js/xadmin.js"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <blockquote class="layui-elem-quote">欢迎：
                                <?php
                                if (date_default_timezone_get() != "1Asia/Shanghai") date_default_timezone_set("Asia/Shanghai");
                                ?>
                                <span class="x-red"><?php echo $_SESSION['ctbms']['user'];?></span>！当前时间:<?php echo date('Y-m-d H:i:s',time());?>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">数据统计</div>
                        <div class="layui-card-body ">
                            <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>投稿数</h3>
                                        <p>
                                            <cite>66</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>会员数</h3>
                                        <p>
                                            <cite>12</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>审阅数</h3>
                                        <p>
                                            <cite>55</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>录用数</h3>
                                        <p>
                                            <cite><?= 25;?></cite></p>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">系统信息</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <tbody>
                                    <tr>
                                        <th>系统版本</th>
                                        <td>1.0.100000</td></tr>
                                    <tr>
                                        <th>服务器地址</th>
                                        <td>ctbms.com</td></tr>
                                    <tr>
                                        <th>操作系统</th>
                                        <td>WINNT</td></tr>
                                    <tr>
                                        <th>运行环境</th>
                                        <td>Apache/2.4.23 (Win32) OpenSSL/1.0.2j mod_fcgid/2.3.9</td></tr>
                                    <tr>
                                        <th>PHP版本</th>
                                        <td>7.3</td></tr>
                                    <tr>
                                        <th>PHP运行方式</th>
                                        <td>cgi-fcgi</td></tr>
                                    <tr>
                                        <th>MYSQL版本</th>
                                        <td>5.5.53</td></tr>
                                    <tr>
                                        <th>上传附件限制</th>
                                        <td>2M</td></tr>
                                    <tr>
                                        <th>执行时间限制</th>
                                        <td>30s</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">开发团队</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <tbody>
                                    <tr>
                                        <th>版权所有</th>
                                        <td><a href="http://fengcrush.cn/" target="_blank">feng</a></td>
                                    </tr>
                                    <tr>
                                        <th>开发者</th>
                                        <td><a href="http://fengcrush.cn/" target="_blank">feng</a></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <style id="welcome_style"></style>
                <div class="layui-col-md12">
                    <blockquote class="layui-elem-quote layui-quote-nm">本系统由layui,php,apache强力驱动。</blockquote></div>
            </div>
        </div>
        </div>
    </body>
</html>