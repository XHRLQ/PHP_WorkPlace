<?php
session_start();

require_once 'request_process.php';

if(isset($_SESSION['account'])){
	unset($_SESSION['account']);
}
 	
if(isset($_POST['login'])){

 	if($_POST['account']!=null && $_POST['password']!=null){
	 	$requestProcess=new RequestProcess;
	 	$requestProcess->manage_login();
	 	// manage_login();
 	}
}

?>

<html>
<head>
	<title>登录</title>
</head>
<body>
	<p style="background-color:#CCCCCC; font-size:40px; font:'黑体'; font-weight:1400; color:#FFFFFF; height:100px;" align="center">

		<label>广纸销售客诉管理平台</label>

	</p>
	<?php
	  if(isset($_POST['login'])){
	?>
	  	<p style="color:#ff0000">
			<label name="warning" >账号名或密码错误</label>
		</p>
	<?php
	  } 
	?>


	<form action="http://127.0.0.1:80/Pro_SaleSys/manage_login.php" method="post" style=" margin-top:160px">
		<table aligen="center" style="font-size:25px;font: '新宋体'" align="center" height="100px" > 
			<tr>
				<td align="right">管理员账号:</td>
				<td><input type="text" height="30px" width="480px" name="account"/></td>
			</tr>
			
			<tr>
				<td  align="right">密码:</td>
				<td><input type="password"  height="30px" width="480px" name="password"/></td>
			</tr>
		</table>
		<p style=" font-size:35px" align="center" >
			<input type="submit" name="login" value="登录"  style="width:100px; height:35px; font: '新宋体'"/>	
		</p>
	</form>
</body>
</html>