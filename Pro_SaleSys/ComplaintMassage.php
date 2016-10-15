<?php
	class ComplaintMassage{
		public $id;
		public $feedBackDate;
		public $clientName;
		public $problemType;
		public $parents;//卷纸编号
		public $contacter;
		public $contactNumber;
		public $guiGe;
		public $dingLiang;
		public $problemDescription;
		public $clientDemmand;
		public $file_;
		public $feedbacker;

		public function getId(){
			return $this->id;
		}

		public function getFeedBackDate(){
			return $this->feedBackDate;
		}

		public function getClientName(){
			return $this->clientName;
		}

		public function getProblemType(){
			return $this->problemType;
		}

		public function getParents(){
			return $this->parents;
		}

		public function getContacter(){
			return $this->contacter;
		}

		public function getContactNumber(){
			return $this->contactNumber;
		}

		public function getGuiGe(){
			return $this->guiGe;
		}

		public function getDingLiang(){
			return $this->dingLiang;
		}

		public function getProblemDescription(){
			return $this->problemDescription;
		}

		public function getClientDemmand(){
			return $this->clientDemmand;
		}

		public function getFile(){
			return $this->file_;
		}

		public function getFeedbacker(){
			return $this->feedbacker;
		}
		
		public function setId($id){
			$this->id=$id;
		}
		
		public function setFeedBackDate($feedBackDate){
			$this->feedBackDate=$feedBackDate;
		}

		public function setClientName($clientName){
			$this->clientName=$clientName;
		}

		public function setProblemType($problemType){
			$this->problemType=$problemType;
		}

		public function setParents($parents){
			$this->parents=$parents;
		}

		public function setContacter($contacter){
			$this->contacter=$contacter;
		}

		public function setContactNumber($contactNumber){
			$this->contactNumber=$contactNumber;
		}

		public function setGuiGe($guiGe){
			$this->guiGe=$guiGe;
		}

		public function setDingLiang($dingLiang){
			$this->dingLiang=$dingLiang;
		}

		public function setProblemDescription($problemDescription){
			$this->problemDescription=$problemDescription;
		}

		public function setClientDemmand($clientDemmand){
			$this->clientDemmand=$clientDemmand;
		}

		public function setFile($file_){
			$this->file_=$file_;
		}

		public function setFeedbacker($feedbacker){
			$this->feedbacker=$feedbacker;
		}
	}


?>