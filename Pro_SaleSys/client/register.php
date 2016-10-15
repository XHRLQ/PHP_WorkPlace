<?php

?>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    	<!-- Bootstrap -->
    	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<!-- jquery文件 -->
		<script src="http://127.0.0.1/Pro_SaleSys/js/jquery-1.7.2.min.js"></script>
	</head>
	<body >
		<div  align="center" style="padding-top: 60px">
			<form class="form-horizontal" role="form">
  				<div class="form-group">
    				<label class="col-sm-3 control-label">邮箱</label>
    				<div class="col-sm-6">
      					<input type="text" class="form-control" name="email" id="email" placeholder="输入可用邮箱进行注册">
    					
    				</div>
    				<label  class="control-label text-danger">*</label>
  				</div>
  				<div class="form-group">
    				<label class="col-sm-3 control-label">密码</label>
    				<div class="col-sm-6">
      					<input type="text" class="form-control" name="password" id="password" placeholder="设置一个新密码">
    					
    				</div>
    				<label class="control-label text-danger">*</label>
  				</div>
  				<div class="form-group">
    				<label class="col-sm-3 control-label">确认密码</label>
    				<div class="col-sm-6">
      					<input type="text" class="form-control" name="repat_password" id="repat_password" placeholder="再次输入密码">
    				</div>
    				<label class="control-label text-danger">*</label>
  				</div>

        		
  				<div class="form-group">
    				<div class="col-sm-offset-3 col-sm-6">
      					<div class="checkbox">
        					<label>
          						<input type="checkbox">记住密码
        					</label>
      					</div>
    				</div>
  				</div>
  				<div class="form-group">
    				<div class="col-sm-offset-3 col-sm-6">
     					<button type="submit" class="btn btn-primary">注册</button>
    				</div>
  				</div>
  				</br>
        		</br>
        		<a href="client_login.php">已有账号?进行登录</a>
			</form>

		</div>
	</body>
</html>