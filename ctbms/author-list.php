<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>信息管理</title>
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
            <div class="layui-card-header">
                <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                <button class="layui-btn" onclick="member_add()" ><i class="layui-icon"></i>添加</button>
            </div>
            <div class="layui-card-body layui-table-body layui-table-main">
                <table class="layui-table layui-form">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" lay-filter="checkall" name="" lay-skin="primary">
                        </th>
                        <th>作者编号</th>
                        <th>姓名</th>
                        <th>学历</th>
                        <th>职称</th>
                        <th>单位</th>
                        <th>联系电话</th>
                        <th>邮箱</th>
                        <th>研究方向</th>
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

                    $result = $coon->query("SELECT * FROM author;");
                    if (!$result){
                        echo "数据库查询失败！";
                    }

                    ?>

                    <tbody>

                    <?php
                    while ($row = $result->fetch_assoc())
                    {
                        $value = $row['canum'];
                        echo '<tr>';
                        echo "<td><input type='checkbox' name='id' value=$value lay-skin='primary'></td>";
                        echo '<td>'.$row["canum"].'</td>';
                        echo "<td>".$row["aname"].'</td>';
                        echo '<td>'.$row["aedu"].'</td>';
                        echo '<td>'.$row["ajobtitle"].'</td>';
                        echo '<td>'.$row["aunit"].'</td>';
                        echo '<td>'.$row["aphone"].'</td>';
                        echo '<td>'.$row["aemail"].'</td>';
                        echo '<td>'.$row["afield"].'</td>';
                        ?>

                        <td class="td-manage">
                            <button class="layui-btn layui-btn layui-btn-xs"  onclick="member_edit(this)">
                                <i class="layui-icon">&#xe642;</i>修改信息栏
                            </button>
                            <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,'id')" href="javascript:;" >
                                <i class="layui-icon">&#xe640;</i>删除
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
        // 监听全选
        form.on('checkbox(checkall)', function(data){

            if(data.elem.checked){
                $('tbody input').prop('checked',true);
            }else{
                $('tbody input').prop('checked',false);
            }
            form.render('checkbox');
        });


    });

    /*用户-添加*/
    function member_add() {
        layer.open({
            type: 2,
            title:'添加',
            area: ['600px','400px'],
            fix: false, //不固定
            maxmin: true,
            shadeClose: true,
            shade:0.4,
            content: './author-add.html',
            end: function () {
                //更新完数据后，刷新页面
                location.reload();
            }
        });
    }
    /*用户-删除*/
    function member_del(obj,id){
        var i = $(obj).parents("tr").find('input').val();
        layer.confirm('确认要删除吗？',function(index){
            var load =layer.load();
            //发异步删除数据
            $.ajax({
                url:"author-delete.php",
                type: "POST",
                data:{
                    canum :i
                },
                dataType:"json",  //回调参数的格式是json
                success: function (res) {
                    if (res['code'] ==1){
                        layer.close(load);
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }else {
                        layer.close(load);
                        layer.msg("删除失败！");
                    }
                },
                error: function (msg) {
                    layer.alert(msg, {icon: 1});
                }
            });

        });
    }

    /*用户-编辑*/
    function member_edit(obj) {
        var i = $(obj).parents("tr").find('input').val();
        layer.open({
            type: 2,
            title:'修改',
            area: ['600px','400px'],
            fix: false, //不固定
            maxmin: true,
            shadeClose: true,
            shade:0.4,
            content: 'author-edit.html',
            success: function(layero,index){
                //找到子窗口body
                var body = layer.getChildFrame('body',index);
                //为子窗口元素赋值
                body.contents().find("#canum").val(i);

            },
            end: function () {
                //更新完数据后，刷新页面
                location.reload();
            }
        });
    }

    function delAll (argument) {
        var ids = [];

        // 获取选中的id
        $('tbody input').each(function(index, el) {
            if($(this).prop('checked')){
                ids.push($(this).val())
            }
        });

        layer.confirm('确认要删除吗？'+ids.toString(),function(index){

            var l = layer.load();
            //异步数据到php后台
            $.ajax({
                url: "authors-delete.php",
                type:"POST",
                data:{
                    ids:ids.toString()
                },
                dataType: "json",
                success: function (res) {
                    if (res['code'] ==1){
                        layer.close(l);
                        //捉到所有被选中的，发异步进行删除
                        layer.msg('删除成功', {icon: 1});
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                    }else {
                        layer.close(l);
                        layer.msg("删除失败！");
                    }
                },
                error: function (msg) {
                    layer.alert(msg, {icon: 1});
                }
            });

        });
    }
</script>
</html>