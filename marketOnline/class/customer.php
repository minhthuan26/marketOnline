<?php
	Class Customer{

		private $db;

		public function __construct(){
			$this->db = new Connection();
		}

		public function getByID($cusid){
			$query = "SELECT * FROM customers WHERE CustomerID='$cusid'";
			$result = $this->db->select($query);
			if($result != false){
				return $result;
			}
			else
				return false;
		}

		public function add($cus){
			$newCusPassword = mysqli_real_escape_string($this->db->link, $cus['Password']);
			$newCusFullname = mysqli_real_escape_string($this->db->link, $cus['Fullname']);
			$newCusAddress = mysqli_real_escape_string($this->db->link, $cus['Address']);
			$newCusCity = mysqli_real_escape_string($this->db->link, $cus['City']);

			if($newCusPassword == "" || $newCusFullname == "" || $newCusAddress == "" || $newCusCity == ""){
				$alert = "Please enter all infomation to regist!";
				return $alert;
			}
			else{
				$query = "INSERT INTO customers (Password, Fullname, Address, City) VALUES ('$newCusPassword', '$newCusFullname', '$newCusAddress', '$newCusCity')";
				$result = $this->db->insert($query);
				if($result != false){
					$ID = mysqli_insert_id($this->db->link);
					$alert = "Done! Your ID to login is: ".$ID;
					return $alert;
				}
				else
					return false;
			}
		}
	}  
?>