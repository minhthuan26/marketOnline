<?php
	include '../session.php';
	include "../connection.php";
	Session::checkLogin();

	Class Login{
		public $db;

		public function __construct(){
			$this->db = new Connection();
		}

		public function checkUser($userID, $userPass){
			$userID = mysqli_real_escape_string($this->db->link, $userID);
			$userPass = mysqli_real_escape_string($this->db->link, $userPass);

			if(empty($userID) || empty($userPass)){
				$alert = "Please enter all infomation to login!";
				return $alert;
			}
			else{
				$query = "SELECT * FROM customers WHERE CustomerID='$userID' AND Password='$userPass' LIMIT 1";
				$result = $this->db->select($query);
				if($result != false){
					$values = mysqli_fetch_array($result);
					Session::set('login', true);
					Session::set('userName', $values['Fullname']);
					Session::set('userPass', $values['Password']);
					Session::set('userID', $values['CustomerID']);
					header('Location:../vegetable/index.php');
				}
				else{
					$alert = "Wrong ID or password!";
					return $alert;
				}
			}
		}
	}
?>