<?php 
	Class Connection{
		public $link;
		public $error;

		public function __construct(){
			$this->dbConnect();
		}

		private function dbConnect(){
			$this->link = new mysqli("localhost", "root", "", "market");
			if(!$this->link){
				$this->error = "Connection fail.".$this->link->connect_error;
				return false;
			}
			return $this->link; 
		}

		public function select($query){
			$select = $this->link->query($query) or die($this->link->error.__LINE__);
			if($select->num_rows > 0)
				return $select;
			else
				return false;
		}

		public function insert($query){
			$insert = $this->link->query($query) or die($this->link->error.__LINE__);
			if($insert)
				return $insert;
			else
				return false;
		}

		public function update($query){
			$update = $this->link->query($query) or die($this->link->error.__LINE__);
			if($update)
				return $update;
			else
				return false;
		}

		public function delete($query){
			$delete = $this->link->query($query) or die($this->link->error.__LINE__);
			if($delete)
				return $delete;
			else
				return false;
		}
	}

?>