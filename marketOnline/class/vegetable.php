<?php  
	Class Vegetable{
		public $db;

		public function __construct(){
			$this->db = new Connection();
		}

		public function getAll(){
			$query = "SELECT * FROM vegetable";
			$result = $this->db->select($query);
			if($result != false)
				return $result;
			else
				return false;
		}

		public function getListByCateID($cateid){
			$query = "SELECT * FROM vegetable WHERE CategoryID='$cateid'";
			$result = $this->db->select($query);
			if($result != false)
				return $result;
			else
				return false;
		}

		public function getListByCateIDs($cateids){
			$len = count($cateids);
			$items = array();
			for($i=0; $i<$len; $i++){
				$query = "SELECT * FROM vegetable WHERE CategoryID='$cateids[$i]'";
				$result = $this->db->select($query);
				if($result != false)
					array_push($items, $result);
			}
			return $items;
			
		}

		public function getByID($vegetableID){
			$query = "SELECT * FROM vegetable WHERE VegetableID='$vegetableID' LIMIT 1";
			$result = $this->db->select($query);
			if($result != false)
				return $result;
			else
				return false;
		}

		public function add($vegetable){
			$cateID = mysqli_real_escape_string($this->db->link, $vegetable['cateID']);
			$vegName = mysqli_real_escape_string($this->db->link, $vegetable['vegName']);
			$vegUnit = mysqli_real_escape_string($this->db->link, $vegetable['vegUnit']);
			$vegAmount = mysqli_real_escape_string($this->db->link, $vegetable['vegAmount']);
			$vegImg = mysqli_real_escape_string($this->db->link, $vegetable['vegImg']);
			$vegPrice = mysqli_real_escape_string($this->db->link, $vegetable['vegPrice']);

			$query = "INSERT INTO vegetable (CategoryID, VegetableName, Unit, Amount, Image, Price) VALUES ('$cateID', '$vegName', '$vegUnit', '$vegAmount', '$vegImg', '$vegPrice')";
			$result = $this->db->insert($query);
			if($result != false)
				return $result;
			else
				return false;
		}
	}
?>