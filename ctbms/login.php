<!DOCTYPE html>
<html lang="en">
<head>
<title>用户登录注册</title>

<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->

<!-- css files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
<link href="css/font-awesome.css" rel="stylesheet"> <!-- Font-Awesome-Icons-CSS -->
    <link rel="stylesheet" href="lib/layui/css/layui.css">
<!-- //css files -->

<!-- online-fonts -->
<link href="css/gfont.css" rel="stylesheet">
<!--//online-fonts -->

<!--引入layui的js做正则-->
    <script src="js/jquery.min.js"></script>
	<script src="./lib/layui/layui.js" charset="UTF-8"></script>
<!--//layui-->

<body>
<!--header-->
<div class="agileheader">
	<h1>在线投稿系统</h1>
</div>
<!--//header-->

<!--main-->
<div class="main-w3l">
	<div class="w3layouts-main">
		<h2>Sign In Now</h2>
			<form action="check_user.php" method="post" class="layui-form">
				<input placeholder="E-MAIL" name="Email" type="email" lay-verify="Email" />
				<span class="icons i1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
				<input placeholder="PASSWORD" name="Password" type="password" lay-verify="required" value="<?php if(!empty($_COOKIE['pwd'])) echo $_COOKIE['pwd'];?>" >
				<span class="icons i2"><i class="fa fa-key" aria-hidden="true"></i></span>
					<input type="submit" value="Sign In" name="login" lay-submit>
			</form>
			<h6><a href="step-back.php">Forgot Password?</a></h6>
			<h3>(or)</h3>
			<div>
				<label><span style="color: #fff;">记住密码：</span><input type="checkbox" name="remember"/></label>
			</div>
	</div>
	<div class="w3layouts-main2">
		<h3>Sign Up Now</h3>
			<form action="" method="post" class="layui-form">
				<input placeholder="USERNAME" id="Name" name="Name" type="text" lay-verify="required" />
				<span class="icons i3"><i class="fa fa-user" aria-hidden="true"></i></span>
				<input placeholder="E-MAIL" id="Email" name="Email" type="email" lay-verify="Email" />
				<span class="icons i4"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
				<input placeholder="PASSWORD" id="Password" name="Password" type="password" lay-verify="required" />
				<span class="icons i5"><i class="fa fa-key" aria-hidden="true"></i></span>
				<input placeholder="密保问题:您在哪个城市工作(输入2-4个汉字)" id="an" name="an" type="text" lay-verify="answer" />
				<span class="icons i6"><i class="fa fa-key" aria-hidden="true"></i></span>
					<input type="submit" value="Sign UP" name="login" lay-submit lay-filter="signUp">
			</form>
	</div>
	<div class="clear"></div>
</div>
<!--//main-->

<!--footer-->
<div class="footer-w3l">
	<p>&copy; 2020 投稿系统. All rights reserved | <a href="http://fengcrush.cn/" target="_blank">feng</a></p>
</div>
<!--//footer-->

<!--layui正则使用-->
<script>
	layui.use(['form','jquery'],function () {
		var form  = layui.form;
		var layer = layui.layer;
		var $ = layui.$;

		//自定义验证规则
        form.verify({
            Email: [
                /^[a-zA-Z][0-9a-zA-Z_]{4,19}@[0-9a-zA-Z_]{1,10}(\.)(com|cn|com.cn|net)$/
                ,'邮箱只能以字母开头由4到19位组成，@后面是com,cn,com.cn,net由1到10位组成'
            ]
            ,answer: [
                /^[\u4e00-\u9fa5]{2,4}$/
                ,'请正确输入2-4个汉字'
            ]
        });

        form.on("submit(signUp)",function (data) {
            var Email,Name,Password,an;
            Email = $("#Email").val();
            Name = $("#Name").val();
            Password = $("#Password").val();
            an = $("#an").val();


            var load = layer.load(1);
            $.ajax({
                url:"check_register.php",
                type:"POST",
                data:{
                    Email:Email,
                    Name:Name,
                    Password:Password,
                    an:an
                },
                success:function (msg) {
                    layer.close(load);
                    if (msg == 'a')
                    {
                        layer.tips('用户名重复','#Name');
                    }else if (msg== "b")
                    {
                        layer.tips('邮箱重复','#Email');
                    }else {
                        layer.alert(msg, {icon: 1});
                    }
                },
                error:function (msg) {
                    alert("注册失败");
                }
            });


            //window.location.href = 'check_register.php?Email='+Email+'&Name='+Name+'&Password='+Password+"&an="+an;
            //layer.tips('用户名重复','#Name');
            return false;
        });


	});
</script>

<!--//layui-->

</body>
</html>