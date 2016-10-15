<?php 
class Client{
	private $account;
	private $password;

	public function setAccount($account){
		$this->account=$account;
	}

	public function setPassword($password){
		$this->password=$password;
	}

	public function getAccount(){
		return $this->account;
	}

	public function getPassword(){
		return $this->password;
	}

}
	

?>