<?php
//引入数据库配置文件
require_once 'db_config.php';
require_once 'ComplaintMassage.php';

class MysqlTool{

  	private $db_host='127.0.0.1';
  	private $db_port='3306';
  	private $db_user='root';
  	private $db_password='root';
  	private $db_name='pro_sale';
  	private $db_charset='utf8';

	public function mysql_connect(){
		$conn=mysqli_connect($this->db_host.':'.$this->db_port,$this->db_user,$this->db_password,$this->db_name);
		if(!$conn){
			printf('连接数据库失败');
			exit();
		}
		$conn->query("SET NAMES 'UTF8'");

		return $conn;
	}

	public function mysql_disconnect($link){
		mysqli_close($link);
	}	

	public function client_login($client){
		
		$tag=false;
		$conn=$this->mysql_connect();
		$stmt = $conn->prepare("select account from t_client where account='".$client->getAccount()."' and pswd='".$client->getPassword()."';");

		$stmt->execute();
		$stmt->bind_result($account);

		if($stmt->fetch()){
				
				$tag=true;
		}

		// $result->close();
		$this->mysql_disconnect($conn);
		return $tag;
	}

	public function addComplaint($complaint){
		$conn=$this->mysql_connect();
		$sql="insert into t_complaint_massage(
			feed_back_date,
			client_name,
			contacter,
			contact_numer,
			problem_type,
			gui_ge,
			ding_liang,
			juan_zhi_id,
			problem_description,
			client_demmand,
			picture,
			feedbacker) values('".
			$complaint->getFeedBackDate()."','".
			$complaint->getClientName()."','".
			$complaint->getContacter()."','".
			$complaint->getContactNumber()."','".
			$complaint->getProblemType()."','".
			$complaint->getGuiGe()."','".
			$complaint->getDingLiang()."','".
			$complaint->getParents()."','".
			$complaint->getProblemDescription()."','".
			$complaint->getClientDemmand()."','".
			$complaint->getFile()."','".
			$complaint->getFeedbacker()."');";
		$stmt=$conn->prepare($sql);
		// $tag=$stmt->execute();
		$tag=true;
		if($stmt->execute()==false)
		 	$tag=false;

		$this->mysql_disconnect($conn);
		return $tag;
	}
}
?>
<!-- create table t_complaint_massage(
			id int primary key auto_increment,
			feed_back_date date,
			client_name  varchar(80),
			contacter varchar(40),
			contact_numer varchar(40),
			problem_type varchar(14) ,
			gui_ge varchar(16),
			ding_liang varchar(16),
			juan_zhi_id varchar(80),
			problem_description varchar(200),
			client_demmand varchar(40),
			picture varchar(80),
			feedbacker varchar(30));
 -->









