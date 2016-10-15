<?php
  session_start();

  if(isset($_SESSION['account'])){
    unset($_SESSION['account']);
    unset($_SESSION['error']);
  }

    

?>
<html>
	<head>
		  <meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    	<!-- Bootstrap -->
    	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<!-- jquery文件 -->
		<script src="http://127.0.0.1/Pro_SaleSys/js/jquery-1.7.2.min.js"></script>
		<title>客户反馈登录</title>
	</head>
	<body  >
		<div align="center" >
			<h1 style="background-color:#CCCCCC;" >
				<label>广纸销售客诉管理平台</label>
			</h1>
		</div>
		<div  align="center">
			<form method="post" action="feedback.php">
        <?php if(isset($_SESSION['error'])){?>
        <div class="input-group">
          <p type="label" name="account"  style="color:ff0000"><?php echo $_SESSION['error']; ?></p>
        </div>
        <?php } ?>
				<div class="input-group">
      		<span class="glyphicon glyphicon-user"></span>
     			<input type="text" name="account" placeholder="账号">
     		</div>
     		</br>
     		<div class="input-group">
     			<span class="glyphicon glyphicon-lock"></span>
      		<input type="password" name="password" placeholder="密码">
      	</div>
      	</br>
      	<button type="submit" name="login" class="btn btn-primary" >登录</button>
      </form>
      	<a href="register.php">没有账号?快速注册</a>
    	</div>
	</body>
</html>
