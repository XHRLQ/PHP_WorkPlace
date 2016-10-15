<?php
require_once "mysql_tool.php";
if(isset($_POST['id'])){
	$mysqlTool=new MysqlTool;
	$mysqlTool->deleteById($_POST['id']);
	
}

?>
