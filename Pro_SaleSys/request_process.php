<?php
//引入数据库配置文件
require_once 'db_config.php';
require_once 'mysql_tool.php';
require_once 'filelist.php';

require_once 'Manager.php';
require_once 'ComplaintMassage.php';
class RequestProcess{

// private $mysqlTool=new MysqlTool;


// public
public function manage_login(){
	if(isset($_POST['login'])){
		$mysqlTool=new MysqlTool;

		$manager=new Manager;
		$manager->setAccount($_POST['account']);
		$manager->setPassword($_POST['password']);

		$result=$mysqlTool->manage_login($manager);
		
		if($result){
			$last_login_time=$mysqlTool->getLastLoginTime($manager);
			$mysqlTool->updateLastLogin($manager);

			session_start();

			$_SESSION["account"]=$manager->getAccount();
			$_SESSION["last_login_time"]=$last_login_time;
			header("Location:manage_index.php");//?account=".$manager->getAccount()."&last_login_time=".$last_login_time
		}
	}
}

public function getAllComplaintMsg(){
	$mysqlTool=new MysqlTool;
	return $mysqlTool->getAllComplaintMsg();
}


public function getComplaintsByProTypes($problemTypes){
		$mysqlTool=new MysqlTool;
		if(count($problemTypes)>0)
			$complaints=$mysqlTool->queryComplaintByProTypes($problemTypes);
		else{
			$complaints=array();
		}

		return $complaints;
}

	// public
public function exportItems(){
	//********************************************************************
		if(isset($_POST['ids'])){
			array_walk($ids,'export');  
		}
		// $data='200'; 
		// ajaxBack($data,'');
	//**************************************************************************
}
	
// }


	// public
public function manage(){
		$conn=$mysqlTool->mysql_connect();
		// ...
		$mysqlTool->mysql_close($conn);
}


}


?>