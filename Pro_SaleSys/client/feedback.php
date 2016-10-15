<?php
session_start();
require_once 'Client.php';
require_once 'mysql_tool.php';

if(isset($_POST['account']) || isset($_SESSION['account'])){
    /*
        用数据库工具查数据库中有木有这个账号
     */
    if(isset($_POST['account'])){
        $client=new Client;  
        $client->setAccount($_POST['account']);
        $client->setPassword($_POST['password']);
        $mysqlTool=new MysqlTool;
        $tag=$mysqlTool->client_login($client);


        if($tag){
            $_SESSION['account']= $_POST['account'];
        }
    } 
    if(isset($_SESSION['account'])){  
    
    
?>
<html>
<head>
	<title>反馈</title>
	<!-- <meta charset=""> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://127.0.0.1/Pro_SaleSys/js/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    
    <!-- jquery文件 -->
    <script src="http://127.0.0.1/Pro_SaleSys/js/jquery-1.7.2.min.js"></script>
    <script src="http://127.0.0.1/Pro_SaleSys/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    
</head>
<body>
	<!-- <div class="input-append date " data-date-format="dd-mm-yyyy" id="date">
    	
        <span class="add-on"><i class="icon-calendar"></i></span>
	</div> -->
        <div  align="center" style="padding-top: 60px">
            <form class="form-horizontal" role="form"  enctype="multipart/form-data" method="post" action="feedback_check.php">
                <div>
                    <label>当前账号:</label><label><?php echo $_SESSION['account'];?></label>
                    <a align="right" href="client_login.php">退出</a>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">反馈日期:</label>
                    <div class="col-sm-2">
                        <input type="text" name="feed_back_date" id="feed_back_date" placeholder="选择反馈日期" readonly="readonly"/>  
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">客户名称:</label>
                    <div class="col-sm-2">
                        <input type="text" name="client_name" id="client_name" placeholder="客户名称">
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">联系人:</label>
                    <div class="col-sm-2">
                        <input type="text" name="contacter" id="contacter" placeholder="联系人">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">联系电话:</label>
                    <div class="col-sm-2">
                        <input type="text" name="contact_number" id="contact_number" placeholder="联系电话">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">问题类型:</label>
                    <div class="col-sm-2">
                    <select  class="form-control" name="problem_type" > 
                        <option value="1">质量</option> 
                        <option value="2">运输</option> 
                        <option value="3">服务</option> 
                        <option value="4">其他</option> 
                    </select>
                    
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">规格(mm):</label>
                    <div class="col-sm-2">
                        <input type="text" name="gui_ge" id="gui_ge" placeholder="规格">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">定量(g/m^2):</label>
                    <div class="col-sm-2">
                        <input type="text" name="ding_liang" id="ding_liang" placeholder="定量">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">卷纸编号:</label>
                    <div class="col-sm-2">
                        <input type="text" name="juan_zhi_id" id="juan_zhi_id" placeholder="卷纸编号">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">问题描述:</label>
                    <div class="col-sm-2">
                        <textarea  name="problem_description" id="problem_description" placeholder="问题描述"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">客户处理要求:</label>
                    <div class="col-sm-2">
                        <textarea name="client_demmand" id="client_demmand" placeholder="客户处理要求"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">附近图片上传（限制两张）:</label>
                    <div class="col-sm-2">
                        <input type="file" name="file" id="file" placeholder="附件图片上传">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">反馈人:</label>
                    <div class="col-sm-2">
                        <input type="text" name="feedbacker" id="feedbacker" placeholder="反馈人">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">确认提交</button>
                    </div>
                </div>
                </br>
                </br>
                <a href="client_login.php">已有账号?进行登录</a>
            </form>

        </div>
        
</body>
</html>
<script>
        $(document).ready(function() {     
          $('#feed_back_date').datepicker({//添加日期选择功能  
            numberOfMonths:1,//显示几个月  
            showButtonPanel:false,//是否显示按钮面板  
            dateFormat: 'yy-mm-dd',//日期格式  
            clearText:"清除",//清除日期的按钮名称  
            closeText:"关闭",//关闭选择框的按钮名称  
            yearSuffix: '年', //年的后缀  
            showMonthAfterYear:true,//是否把月放在年的后面  
            defaultDate:new Date().getDate(),//默认日期  
            minDate:'1970-01-01',//最小日期  
            maxDate:'2070-01-01',//最大日期  
            monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],  
            dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],  
            dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],  
            dayNamesMin: ['日','一','二','三','四','五','六'],  
            // onSelect: function(selectedDate) {//选择日期后执行的操作  
            //     alert(selectedDate);  
            // }  
            });     
      });  
</script>


<?php
    }else{
        header("Location:client_login.php");
        $_SESSION['error']="账号密码错误";
    }
}
?>