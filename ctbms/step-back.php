<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>密码找回</title>
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">    
    <link href="lib/layui/css/layui.css" rel="stylesheet"/>
    <link href="./step-lay/step.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-body" style="padding-top: 40px;">
                <div class="layui-carousel" id="stepForm" lay-filter="stepForm" style="margin: 0 auto;">
                    <div carousel-item>
                        <div>
                            <form class="layui-form" style="margin: 0 auto;max-width: 460px;padding-top: 40px;">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">邮箱:</label>
                                    <div class="layui-input-block">
                                        <input id="iemail" type="text" placeholder="请填写注册邮箱" class="layui-input" lay-verify="email" autocomplete="on" required />
    
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">密保答案:</label>
                                    <div class="layui-input-block">
                                        <input id="ianswer" type="text" placeholder="您在哪个城市工作" value="" class="layui-input" lay-verify="required">
                                    </div>
                                </div>


                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <button class="layui-btn" lay-submit lay-filter="formStep">
                                            &emsp;下一步&emsp;
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div>
                            <form class="layui-form" style="margin: 0 auto;max-width: 460px;padding-top: 40px;">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">您的邮箱:</label>
                                    <div class="layui-input-block">
                                        <div class="layui-form-mid layui-word-aux" id="cemail"></div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">您的密保答案:</label>
                                    <div class="layui-input-block">
                                        <div class="layui-form-mid layui-word-aux" id="canswer"></div>
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <button type="button" class="layui-btn layui-btn-primary pre">上一步</button>
                                        <button class="layui-btn" lay-submit lay-filter="formStep2">
                                            &emsp;确认&emsp;
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <hr>
                <div style="color: #666;margin-top: 30px;margin-bottom: 40px;padding-left: 30px;">
                    <h3>说明</h3><br>
                    <h4>找回密码</h4>
                    <p>根据用户邮箱及密保问题找回密码。</p>
                </div>
            </div>
        </div>
    </div>
    <script src="./lib/layui/layui.js"></script>
    <script src="./step-lay/step.js"></script>
    <script>
        layui.config({
            base:'./step-lay/'
        }).use([ 'form', 'step','jquery'], function () {
            var $ = layui.$
                , form = layui.form
                , step = layui.step;

            step.render({
                elem: '#stepForm',
                filter: 'stepForm',
                width: '100%', //设置容器宽度
                stepWidth: '750px',
                height: '300px',
                stepItems: [{
                    title: '填写邮箱及密保问题'
                }, {
                    title: '确认信息'
                }]
            });


            var iemail;
            var ianswer;
            form.on('submit(formStep)', function (data) {
                //iemail = $("input[name='iemail']").val();

                //jquery获取邮箱与密保问题并设置到第二个表单中
                iemail = $("#iemail").val();
                $("#cemail").html(iemail);
                ianswer = $("#ianswer").val();
                $("#canswer").html(ianswer);
                //转到下一个表单
                step.next('#stepForm');
                return false;
            });

            form.on('submit(formStep2)', function (data) {
                //step.next('#stepForm');
                $.ajax({
                    url:"check_back.php",
                    type:"POST",
                    data:{
                        email:iemail,
                        answer:ianswer
                    },
                    success:function (msg) {
                        alert(msg);
                    },
                    error:function (msg) {
                        alert("修改失败");
                    }
                })

                //window.location.href='check_back.php?email='+iemail+'&answer='+ianswer;
                return false;
            });

            $('.pre').click(function () {
                step.pre('#stepForm');
            });

            $('.next').click(function () {
                step.next('#stepForm');
            });
        })
    </script>
</body>
</html>
