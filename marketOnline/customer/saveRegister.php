<?php
	include "../connection.php";
	include "../class/customer.php";

	Class Register{
		public $db;

		public function __construct(){
			$this->db = new Connection();
		}

		public function addRegister($cus){
			$customer = new Customer();
			return $customer->add($cus);
		}
	}
?>