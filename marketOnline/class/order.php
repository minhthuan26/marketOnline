<?php  
	Class Order{
		private $db;


		public function __construct(){
			$this->db = new Connection();
		}

		public function getAllOrder($cusID){
			$query = "SELECT * FROM `order` WHERE CustomerID='$cusID'";
			$result = $this->db->select($query);
			if($result != false)
				return $result;
			else
				return false;
		}

		public function getOrderDetail($orderid){
			$query = "SELECT * FROM orderdetail WHERE OrderID='$orderid'";
			$result = $this->db->select($query);
			if($result != false)
				return $result;
			else
				return false;
		}

		public function addOrder($order){
			$Date = "Date";
			$cusID = mysqli_real_escape_string($this->db->link, $order['cusID']);
			$date = mysqli_real_escape_string($this->db->link, $order['Date']);
			$total = mysqli_real_escape_string($this->db->link, $order['Total']);
			$note = mysqli_real_escape_string($this->db->link, $order['note']);

			if($cusID == "" || $date == "" || $total == 0){
				$alert = "Please enter all order's information.";
				return $alert;
			}
			else{
				$query = "INSERT INTO `order` (CustomerID, $Date, Total, Note) VALUES ('$cusID', '$date', '$total', '$note')";
				$result = $this->db->insert($query);
				if($result != false){
					$orderID = mysqli_insert_id($this->db->link);
					
					return $orderID;
				}
				else
					return false;
			}
		}

		public function addDetail($detail){
			$orderID =  mysqli_real_escape_string($this->db->link, $detail['orderID']);
			$vegID =  mysqli_real_escape_string($this->db->link, $detail['vegID']);
			$vegQuan =  mysqli_real_escape_string($this->db->link, $detail['Quantity']);
			$vegPrice = mysqli_real_escape_string($this->db->link, $detail['Price']);
			
			if($vegID == "" || $vegQuan == "" || $vegPrice == ""){
				$alert = "Please enter all order's information.";
				return $alert;
			}
			else{
				$query = "INSERT INTO orderdetail (OrderID, VegetableID, Quantity, Price) VALUES ('$orderID', '$vegID', '$vegQuan', '$vegPrice')";
				$result = $this->db->insert($query);
				if($result != false){
					return $result;
				}
				else
					return false;
			}
		}

	}
?>