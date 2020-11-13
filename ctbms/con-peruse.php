<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>稿件审阅</title>
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
                <table class="layui-table layui-form">
                    <thead>
                    <tr>
                        <th>稿件名称</th>
                        <th>稿件位置</th>
                        <th>审稿人数</th>
                        <th>审阅状态</th>
                        <th>操作</th>
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
                        $cname = $row['cname'];
                        if ($row["perusenum"] >=2)
                        {
                            $outcome = "<span style='color: #d39e00'>已录用</span>";
                        }else{
                            $outcome = "未通过";
                        }
                        echo '<tr>';
                        echo "<input name='id' value='$cname' type='hidden'>";
                        echo '<td>'.$row["cname"].'</td>';
                        echo '<td>'.$row["con"].'</td>';
                        echo '<td>'.$row["perusenum"].'</td>';
                        echo '<td>'.$outcome.'</td>';
                        ?>

                        <td class="td-manage">
                            <button class="layui-btn layui-btn layui-btn-xs"  onclick="member_edit(this)">
                                <i class="layui-icon">&#xe63c;</i>审阅
                            </button>
                        </td>
                        <?php
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

    });


    /*审阅稿件*/
    function member_edit(obj) {
        var i = $(obj).parents("tr").find('input').val();
        layer.open({
            type: 2,
            title:'审阅',
            area: ['600px','400px'],
            fix: false, //不固定
            maxmin: true,
            shadeClose: true,
            shade:0.4,
            content: 'con-perusecheck.html',
            success: function(layero,index){
                //找到子窗口body
                var body = layer.getChildFrame('body',index);
                //为子窗口元素赋值
                body.contents().find("#cname").val(i);

            },
            end: function () {
                //更新完数据后，刷新页面
                location.reload();
            }
        });
    }

</script>
</html>