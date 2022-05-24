<?php  
	Class Category{
		public $db;

		public function __construct(){
			$this->db = new Connection();
		}

		public function getAll(){
			$query = "SELECT * FROM category";
			$result = $this->db->select($query);
			if($result != false)
				return $result;
			else
				return false;
		}

		public function add($cate){
			$newCateName = mysqli_real_escape_string($this->db->link, $cate['Name']);
			$newCateDes = mysqli_real_escape_string($this->db->link, $cate['Description']);

			if($newCateName == "" || $newCateDes == ""){
				$alert = "Please enter all infomation to add a new category!";
				return $alert;
			}
			else{
				$query = "INSERT INTO category (Name, Description) VALUES ('$newCateName', '$newCateDes')";
				$result = $this->db->insert($query);
				if($result != false){
					$alert = "Done!";
					return $alert;
				}
				else
					return false;
			}
		}

	}
?>