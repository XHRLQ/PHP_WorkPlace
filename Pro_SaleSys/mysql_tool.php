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
		$conn->query("SET NAMES UTF8");
		return $conn;
	}

	public function mysql_disconnect($link){
		mysqli_close($link);
	}	

	public function manage_login($manager){
		
		$tag=false;
		$conn=$this->mysql_connect();
		$stmt = $conn->prepare("select account from t_manager where account='".$manager->getAccount()."' and password='".$manager->getPassword()."';");

		$stmt->execute();
		$stmt->bind_result($account);


		if($stmt->fetch()){
				
				$tag=true;
		}

		
		// $result->close();
		$this->mysql_disconnect($conn);
		return $tag;
	}

	public function updateLastLogin($manager){
		$conn=$this->mysql_connect();
		
		$stmt = $conn->prepare("update t_manager set last_login_time='".date('Y-m-d')."' where account='".$manager->getAccount()."';");
		$stmt->execute();

		$this->mysql_disconnect($conn);

	}

	public function getAllComplaintMsg(){
		$conn=$this->mysql_connect();

		$stmt = $conn->prepare("select id,feed_back_date,contacter,client_name,contact_numer,problem_type,
			gui_ge,ding_liang,juan_zhi_id,problem_description,client_demmand,picture,feedbacker from t_complaint_massage");
		$stmt->execute();
		$stmt->bind_result($id,$feed_back_date,$contacter,$client_name,$contact_numer,$problem_type,
			$gui_ge,$ding_liang,$juan_zhi_id,$problem_description,$client_demmand,$picture,$feedbacker);

		$complaints=array();
		while($stmt->fetch()){
			$complaint=new ComplaintMassage;

			$complaint->setId($id);
			$complaint->setFeedBackDate($feed_back_date);
			$complaint->setClientName($client_name);
			$complaint->setProblemType($problem_type);
			$complaint->setParents($juan_zhi_id);
			$complaint->setContacter($contacter);
			$complaint->setContactNumber($contact_numer);
			$complaint->setGuiGe($gui_ge);
			$complaint->setDingLiang($ding_liang);
			$complaint->setProblemDescription($problem_description);
			$complaint->setClientDemmand($client_demmand);
			$complaint->setFile($picture);
			$complaint->setFeedbacker($feedbacker);

			
			array_push($complaints, $complaint);
		}


		$this->mysql_disconnect($conn);
		return $complaints;
	}

	public function getLastLoginTime($manager){
		$conn=$this->mysql_connect();
		$stmt = $conn->prepare("select last_login_time from t_manager where account='".$manager->getAccount()."';");
		$stmt->execute();
		$stmt->bind_result($last_login_time);
		// $this->mysql_disconnect($conn);
		
		$this->mysql_disconnect($conn);
		return $last_login_time;
	}

	public function getComplaintByIds($ids){
		$conn=$this->mysql_connect();
		// $id=(int)$id;
		// 
		$complaints=array();
		$sql="select id,feed_back_date,contacter,client_name,contact_numer,problem_type,
			gui_ge,ding_liang,juan_zhi_id,problem_description,client_demmand,picture,feedbacker from t_complaint_massage where id=";
		for($i=0;$i<count($ids);$i++){
			if($i==0)
				$sql=$sql.$ids[$i];
			else
				$sql=$sql." || id=".$ids[$i];
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id,$feed_back_date,$contacter,$client_name,$contact_numer,$problem_type,
			$gui_ge,$ding_liang,$juan_zhi_id,$problem_description,$client_demmand,$picture,$feedbacker);

		
		while($stmt->fetch()){
			$complaint=new ComplaintMassage;
			$complaint->setId($id);
			$complaint->setFeedBackDate($feed_back_date);
			$complaint->setClientName($client_name);
			$complaint->setProblemType($problem_type);
			$complaint->setParents($juan_zhi_id);
			$complaint->setContacter($contacter);
			$complaint->setContactNumber($contact_numer);
			$complaint->setGuiGe($gui_ge);
			$complaint->setDingLiang($ding_liang);
			$complaint->setProblemDescription($problem_description);
			$complaint->setClientDemmand($client_demmand);
			$complaint->setFile($picture);
			$complaint->setFeedbacker($feedbacker);

		
			array_push($complaints, $complaint);
		}


		$this->mysql_disconnect($conn);
		return $complaints;
	}

	public function queryComplaintByProTypes($probleTypes){
		$conn=$this->mysql_connect();
		
		$complaints=array();
		$sql="select id,feed_back_date,contacter,client_name,contact_numer,problem_type,
			gui_ge,ding_liang,juan_zhi_id,problem_description,client_demmand,picture,feedbacker from t_complaint_massage where problem_type='";
		for($i=0;$i<count($probleTypes);$i++){
			if($i==0)
				$sql=$sql.$probleTypes[$i]."'";
			else
				$sql=$sql." || problem_type='".$probleTypes[$i]."'";
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id,$feed_back_date,$contacter,$client_name,$contact_numer,$problem_type,
			$gui_ge,$ding_liang,$juan_zhi_id,$problem_description,$client_demmand,$picture,$feedbacker);

		
		while($stmt->fetch()){
			$complaint=new ComplaintMassage;
			$complaint->setId($id);
			$complaint->setFeedBackDate($feed_back_date);
			$complaint->setClientName($client_name);
			$complaint->setProblemType($problem_type);
			$complaint->setParents($juan_zhi_id);
			$complaint->setContacter($contacter);
			$complaint->setContactNumber($contact_numer);
			$complaint->setGuiGe($gui_ge);
			$complaint->setDingLiang($ding_liang);
			$complaint->setProblemDescription($problem_description);
			$complaint->setClientDemmand($client_demmand);
			$complaint->setFile($picture);
			$complaint->setFeedbacker($feedbacker);

		
			array_push($complaints, $complaint);
		}	
		
		
		$this->mysql_disconnect($conn);
		return $complaints;
	}

	public function queryComplaintById($id){
		$conn=$this->mysql_connect();
		
		$complaints=array();
		$sql="select id,feed_back_date,contacter,client_name,contact_numer,problem_type,
			gui_ge,ding_liang,juan_zhi_id,problem_description,client_demmand,picture,feedbacker from t_complaint_massage where id=".$id;
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id,$feed_back_date,$contacter,$client_name,$contact_numer,$problem_type,
			$gui_ge,$ding_liang,$juan_zhi_id,$problem_description,$client_demmand,$picture,$feedbacker);

		$complaint=new ComplaintMassage;
		while($stmt->fetch()){			
			$complaint->setId($id);
			$complaint->setFeedBackDate($feed_back_date);
			$complaint->setClientName($client_name);
			$complaint->setProblemType($problem_type);
			$complaint->setParents($juan_zhi_id);
			$complaint->setContacter($contacter);
			$complaint->setContactNumber($contact_numer);
			$complaint->setGuiGe($gui_ge);
			$complaint->setDingLiang($ding_liang);
			$complaint->setProblemDescription($problem_description);
			$complaint->setClientDemmand($client_demmand);
			$complaint->setFile($picture);
			$complaint->setFeedbacker($feedbacker);

		}	
		
		
		$this->mysql_disconnect($conn);
		return $complaint;
	}

	public function deleteById($id){
		$conn=$this->mysql_connect();

		// $stmt = $conn->prepare("delete from t_complaint_massage where id=".$id.";");
		// $stmt->execute();
		// // $stmt->bind_result($last_login_time);

		// sleep(5);
		$stmt = $conn->prepare("select picture from t_complaint_massage where id=".$id.";");
		$stmt->execute();
		$stmt->bind_result($picture);
		$result = @unlink ('client/upfile/'.$picture); 

		$this->mysql_disconnect($conn);

	}
}
?>