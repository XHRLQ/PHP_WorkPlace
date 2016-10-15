<?php
	class Manager{
		private $account;
		private $password;

		public function getAccount(){
			return $this->account;
		}

		public function getPassword(){
			return $this->password;
		}

		public function setAccount($acc){
			$this->account=$acc;
		}

		public function setPassword($pswd){
			$this->password=$pswd;
		}

	}

?>