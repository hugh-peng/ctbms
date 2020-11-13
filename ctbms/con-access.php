<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>稿件进度</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <script src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">本页</a>
            <a>
              <cite>导航</cite></a>
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card-body layui-table-body layui-table-main">
                <h3 align="center">已经通过的稿件列表</h3>
                <hr>
                <table class="layui-table layui-form">
                    <thead>
                    <tr>
                        <th>稿件名称</th>
                        <th>通讯作者</th>
                        <th>通知</th>
                        <th>作者缴费</th>
                    </tr>
                    </thead>

                    <?php
                    require './common/function.php';
                    require './common/init.php';

                    if (!isset($_SESSION['ctbms']['user']))
                    {
                        redirect('login.php');
                    }
                    /*获取数据库连接*/
                    try {
                        $coon = db_connect();
                    } catch (Exception $e) {}

                    $result = $coon->query("SELECT * FROM ctbms_contribute;");
                    if (!$result){
                        echo "数据库查询失败！";
                    }

                    ?>

                    <tbody>

                    <?php
                    while ($row = $result->fetch_assoc())
                    {
                        if ($row['perusenum'] >= 2){
                            echo '<tr>';
                            echo '<td>'.$row["cname"].'</td>';
                            echo '<td>'.$row["cpauthor"].'</td>';

                        ?>

                        <td>
                            <input type="checkbox" name="switch"  lay-text="通知作者|已停用"  lay-skin="switch" lay-filter="switchT">
                        </td>

                        <td>
                            <input type="checkbox" name="switch"  lay-text="作者缴费|已停用" lay-skin="switch" lay-filter="switchT">
                        </td>

                        <?php
                        }
                        echo '<tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
</body>
<script>
    layui.use(['form','layer','jquery'], function(){
        var  form = layui.form;
        var layer = layui.layer;
        var $ = layui.jquery;

        //监听指定开关
        form.on('switch(switchT)',function (data) {
            if (this.checked){
                layer.msg('模拟通讯动作',{
                    offset:'6px'
                });
            }else {
                layer.msg('已经停止',{
                    offset:'6px'
                });
            }
        });

    });


</script>
</html>