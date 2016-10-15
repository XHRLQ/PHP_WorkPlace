<?php
session_start();

if(isset($_SESSION['account'])){
	require_once "mysql_tool.php";
	require_once "request_process.php";

	$requestProcess=new RequestProcess;
	
	if(isset($_POST['lookup'])){
		if(isset($_POST['problemType'])){
			$problemTypes=$_POST['problemType'];
			$clientComplaintMsg=$requestProcess->getComplaintsByProTypes($problemTypes);
		}
	}else{

		$clientComplaintMsg=$requestProcess->getAllComplaintMsg();
	}
	

	function play($item, $key){
		echo "<tr id=$item->id>
				<td bgcolor='#CCFFFF'><input type='checkbox' name='item'  /></td>
				<td bgcolor='#CCFFCC'> $item->feedBackDate</td>
				<td bgcolor='#CCFFFF'> $item->clientName</td>
				<td bgcolor='#CCFFCC'> $item->problemType</td>
				<td bgcolor='#CCFFFF'> $item->parents</td>
				<td bgcolor='#CCFFCC'> <a color='#00CC33' href='' name='detail'>查看详情</a>&nbsp;</td>
				<td bgcolor='#CCFFCC'> <a color='#00CC33' href='' name='delete'>删除</a></td>
			  </tr>";
	}
?>

<html>
<head>
	<title>主页</title>

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <!--<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>-->
	<script src="http://127.0.0.1/Pro_SaleSys/js/jquery-1.7.2.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <!--<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
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
		<label><a name="exit" href="/Pro_SaleSys/manage_login.php">退出</a></label>
	</div>

	
		<div style="background-color:#cccccc; width:240px; height:480px" align="center" > 
			<div style="background-color:#AAAAAA;padding-top:10px;padding-bottom:10px;font-size:25px; font:'宋体';">
				<label style=" text-align:center" >反馈表单</label>
			</div>
		</div>
		<div style="background-color:#EEEEFF;font-size:25px; font:'宋体';padding-left:20px; position:relative; left:240px; top:-480px" align="left"> 
			<form method="post" action="">
			<div style="border-bottom:thin;border-color: #AAAAAA">
				<label>筛选：</label>
				<label style="padding-left:20px">日期：</label>
				<select style="width:80px">
					<option></option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option>
				</select>
				<label>月</label>
				<select style="width:80px">
				</select>
				<label>日</label>
				<label style="padding-left:20px; padding-right:20px">至</label>
				<select  style="width:80px">
					<option></option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option>
				</select>
				<label>月</label>
				<select  style="width:80px"></select>
				<label>日</label>
			</div>
		</br>
			<div style="font:'新宋体';" name="chooseProblemType">
			
				<label style="padding-left:80px">问题类型：</label>
				<input type="button" value="全选/取消" name="allType" style=" background-color:#666666; color:#BBBBBB; padding:2px;font-size:20px" />
				<input type="checkbox" name="problemType[]" value="1" style="padding-left:10px"/><!-- <label>1</label> --><!-- 质量 -->
				<input type="checkbox" name="problemType[]" value="2" style="padding-left:10px"/><!-- <label>2</label> --><!-- 运输 -->
				<input type="checkbox" name="problemType[]" value="3" style="padding-left:10px"/><!-- <label>3</label> --><!-- 服务 -->
				<input type="checkbox" name="problemType[]" value="4" style="padding-left:10px"/><!-- <label>4</label> --><!-- 其他 -->
				<input name="lookup" type="submit" value="查询" style=" background-color:#666666; color:#BBBBBB; padding:2px;  font-size:20px" />
			</div>
	
			</form>
			<!-- <form  method="post" action=""> -->
			<div style="border-top: solid;border-color: #AAAAAA;">
				<div style=" margin-bottom:20px;margin-top: 20px;">
					<input name="showAll" type="button" value="显示全部" style="padding-top: 2px;padding-bottom: 2px; background-color:#00CC33; color:#ffffff; width:100px;  font-size:20px;" />
					<label style=" color:#FF0000; font-size:15px">*</label><label style="font-size:15px">点击此按钮直接显示所有表单项</label>
					<input name="exportExcel" type="button" value="导出EXCEL" style=" background-color:#00CC33; color:#ffffff; width:120px; padding-top: 2px;padding-bottom: 2px;font-size:20px;" />
				</div>
				<table style="text-align:center;font-size: 20px;">
					<tr><td bgcolor="#CCFFFF"><input type="checkbox" name="selectAllItem"/>全选/取消</td>
					 <td  width="190" bgcolor="#CCFFCC">反馈日期</td> 
					 <td  width="210"  bgcolor="#CCFFFF">客户名称</td>
					 <td  width="110"  bgcolor="#CCFFCC">问题类型</td>
					 <td width="200"  bgcolor="#CCFFFF">卷纸编号</td>
					<td width="60" colspan="2"  bgcolor="#CCFFCC">操作</td>
					</tr>
					<?php 
						if(isset($clientComplaintMsg))
							array_walk($clientComplaintMsg,'play');  
					?>
			  	</table>
			</div>
			<!-- </form> -->
		</div>
	<div style="background-color:#ffffff; width:240px; position:relative" align="center" ></div>
</body>
<script type="text/javascript">

	$('input[name="allType"]').click(function(){
		
		$(':checkbox[name="problemType[]"]').each(function(){
			if($(this).prop("checked")){
				$(this).prop("checked",false);
			}else{
				$(this).prop("checked",true);
			}
		});
	});
	$('input[name="showAll"]').click(function(){
		// alert($('label[name="account"]').text());
		location.href ="manage_index.php";//页面跳转
	});

	$('input[name="selectAllItem"]').click(function(){
		$(':checkbox[name="item"]').each(function(){
			if($(this).prop("checked")){
				$(this).prop("checked",false);
			}else{
				$(this).prop("checked",true);
			}
		});
	});
	$('input[name="exportExcel"]').click(function(){
		
		var ids=[];
		$(':checkbox[name="item"]:checked').each(function(){
			ids.push($(this).parent().parent().prop('id'));
		
		});
		if(ids.length>0){
			if(confirm("是否确定导出所有选择的Excel")){
				//********************************************************************
				$.post('',
            		{ids: ids },
            		function(){
            			
            			location.href ="export_excels.php?ids="+ids;
            		}
            	);
            	// $.ajax({
            	// 	type:"post",
            	// 	url:"export_excels.php",
            	// 	data:"ids="+ids;
            	// 	async:true,
            	// 	success:function(data){
            	// 		location.href ="test.php";
            	// 	}
            	// });
        	};
		}else{
			alert("未选择任何表单项，请选择后再进行导出EXCEL操作");
		}
	});	

	$('a[name="delete"]').click(function(){
		var id=$(this).parent().parent().attr("id");
		$.post('delete.php', {id:id});
		
	});
	$('a[name="detail"]').click(function(){
		var id=$(this).parent().parent().attr("id");
		$(this).removeAttr("href");
		location.href ="detail.php?id="+id;//+"&account="+$('label[name="account"]').html()+"&last_login_time="+$('label[name="last_login_time"]').html();
		
	});
	$('a[name="exit"]').click(function(){
		
		location.href ="detail.php?id="+id;//+"&account="+$('label[name="account"]').html()+"&last_login_time="+$('label[name="last_login_time"]').html();
		
	});
</script>
</html>

<?php }
else{
	header("Location:manage_login.php");
}?>