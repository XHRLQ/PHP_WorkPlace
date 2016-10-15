<?php
session_start();

if(isset($_SESSION['account'])){
	require_once "mysql_tool.php";
	
	$mysqlTool=new MysqlTool;
	if(isset($_POST['delete'])){
		
		echo $_POST['id'];
		$mysqlTool->deleteById($_GET['id']);
		header("Location:manage_index.php");
	}
	
	$complaint=$mysqlTool->queryComplaintById($_GET['id']);
	
?>
<html>
<head>
	<title>详细信息</title>
	<script src="http://127.0.0.1/Pro_SaleSys/js/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div style="background-color:#CCCCCC; font-size:40px; font:'黑体'; font-weight:1400; color:#FFFFFF; height:100px; padding-top:40px" align="center">

		<label >广纸销售客诉管理平台</label>

	</div>
	
	
	<div style="background-color:#DDDDff; font-size:25px; font:'宋体'; color:#FFFFFF; height:35px; padding-top:10px;padding-bottom:10px;"  >

		<label style="padding-left:20px">当前管理员账号:</label>
		<label name="account"><?php echo $_SESSION['account']; ?></label>
		<label style="padding-left:20px">上次登录时间：</label>
		<label name="last_login_time"><?php echo $_SESSION['last_login_time']; ?></label>
		<label><a href="/Pro_SaleSys/manage_login.php">退出</a></label>
	</div>
	
	<div style="padding-top:40px;padding-left:140px">
		<form action="detail.php?id=<?php echo $_GET['id'] ?>"+ method="post">
			<table style="text-align:center;font-size: 20px; " border="1xp">
				<tr><td width="290" bgcolor="#CCFFCC">反馈日期</td><td width="290"><?php echo $complaint->getFeedBackDate();?></td><td  width="290" bgcolor="#CCFFCC">反馈人</td><td width="290"><?php echo $complaint->getClientName();?></td></tr>
				<tr><td width="190" bgcolor="#CCFFCC">客户名称</td><td width="190" colspan="3"><?php echo $complaint->getClientName();?></td></tr>
				<tr><td width="190" bgcolor="#CCFFCC">联系人</td><td width="190"><?php echo $complaint->getContacter();?></td><td  width="190" bgcolor="#CCFFCC">联系电话</td><td width="190"><?php echo $complaint->getContactNumber();?></td></tr>
				<tr><td width="190" bgcolor="#CCFFCC">问题类型</td><td width="190"><?php echo $complaint->getProblemType()?></td><td  width="190" bgcolor="#CCFFCC">纸卷编号</td><td width="190"><?php echo $complaint->getParents();?></td></tr>
				<tr><td width="190" bgcolor="#CCFFCC">规格(mm)</td><td width="190"><?php echo $complaint->getGuiGe();?></td><td  width="190" bgcolor="#CCFFCC">定量(g/m^2)</td><td width="190"><?php echo $complaint->getDingLiang();?></td></tr>
				<tr><td width="190" height="190" bgcolor="#CCFFCC"  >问题描述</td>     <td  colspan="3" style="text-align:left"><?php echo $complaint->getProblemDescription();?></td></tr>
				<tr><td width="190" height="190" bgcolor="#CCFFCC"  >客户处理要求</td> <td  colspan="3" style="text-align:left"><?php echo $complaint->getClientDemmand();?></td></tr>
				<tr><td width="190" height="190" bgcolor="#CCFFCC"  >图片附件</td>     <td  colspan="3"><img src="<?php echo 'client/upfile/'.$complaint->getFile();?>" width="160px" height="160px"></td></tr>
			</table>
			<div style="align:center"><input type="button" name="goback" value="返回"/> <input type="submit" name="delete" value="删除"/></div>
		</form>
	</div>

</body>
<script type="text/javascript">
	$('input[name="goback"]').click(function(){
		location.href ="manage_index.php";
	});

</script>
</html>

<?php }
else{
	header("Location:manage_login.php");
}?>