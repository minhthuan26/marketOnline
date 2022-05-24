<?php 
	include "../class/vegetable.php";
	include "../class/category.php";
	include "../connection.php";
	include "../session.php";
	Session::checkSession();
	$db = new Connection();
	$veg = new Vegetable();
	$checkFlag = 1;
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$_SESSION['tmpValue']['valueName'] = $_POST['vegName'];
		$_SESSION['tmpValue']['valueAmount'] = $_POST['vegAmount'];
		$_SESSION['tmpValue']['valuePrice'] = $_POST['vegPrice'];
		if(empty($_POST['vegName'])){
			$_SESSION['error']['errorName'] = "Please enter the new vegetable name!";
			$checkFlag = 0;
		}
		else{
			$vegList = $veg->getAll();
			$tmp = 0;
			while($vegValues = mysqli_fetch_array($vegList)){

				if(strcasecmp($_POST['vegName'], $vegValues['VegetableName']) == 0){
					$_SESSION['error']['errorName'] = "This vegetable name is already exists!";
					$checkFlag = 0;
				}	
			}
			if($checkFlag == 1)
				$_SESSION['error']['errorName'] = "";
		}
				
		if(empty($_POST['vegAmount'])){
			$_SESSION['error']['errorAmount'] = "Please enter the new vegetable amount!";
			$checkFlag = 0;
		}
		else{
			if(is_numeric($_POST['vegAmount']) == 0){
				$_SESSION['error']['errorAmount'] = "Amount must be number!";
				$checkFlag = 0;
			}
			else{
				if($_POST['vegAmount'] < 0){
					$_SESSION['error']['errorAmount'] = "Amount must be equal to 0 or greater!";
					$checkFlag = 0;
				}
				else
					$_SESSION['error']['errorAmount'] = "";
			}
		}

		if(empty($_POST['vegPrice'])){
			$_SESSION['error']['errorPrice'] = "Please enter the new vegetable price!";
			$checkFlag = 0;
		}
		else{
			if(is_numeric($_POST['vegPrice']) == 0){
				$_SESSION['error']['errorPrice'] = "Price must be number!";
				$checkFlag = 0;
			}
			else{
				if($_POST['vegPrice'] < 0){
					$_SESSION['error']['errorPrice'] = "Price must be equal to 0 or greater!";
					$checkFlag = 0;
				}
				else
					$_SESSION['error']['errorPrice'] = "";
			}
		}

		$imageFolder = "images/";
		if(empty(basename($_FILES["vegImage"]["name"]))){
			$_SESSION['error']['errorImage'] = "Please choose an image file!";
			$checkFlag = 0;
		}
		else{
			$imageFullDirection = $imageFolder . basename($_FILES["vegImage"]["name"]);
			$imageType = strtolower(pathinfo($imageFullDirection, PATHINFO_EXTENSION));
			$check = getimagesize($_FILES["vegImage"]["tmp_name"]);
					
					
			// Check if image file is a actual image or fake image
			if($check == false) {
				$_SESSION['error']['errorImage'] = "This file is not an image.";
				$checkFlag = 0;
			}

			// Check if file already exists
			if(file_exists($imageFullDirection)) {
				$_SESSION['error']['errorImage'] = "This file already exists.";
				$checkFlag = 0;
			}

			// Check file size
			if($_FILES["vegImage"]["size"] > 2048000) {
				$_SESSION['error']['errorImage'] = "This file your file is too large.";
				$checkFlag = 0;
			}

			// Allow certain file formats
			if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif" ) {
				$_SESSION['error']['errorImage'] = "The file must be only JPG, JPEG, PNG & GIF.";
				$checkFlag = 0;
			}

			if($checkFlag == 1)
				$_SESSION['error']['errorImage'] = "";

		}
	}
	if($checkFlag == 0){
		header('Location: new.php');
	}
	else{
		$cateName = $_POST['category'];
		$query = "SELECT CategoryID FROM category WHERE Name='$cateName'";
		$result = $db->select($query);
		$value = mysqli_fetch_array($result);
		$vegetable = array(
			"cateID" => $value['CategoryID'],
			"vegName" => $_POST['vegName'],
			"vegAmount" => $_POST['vegAmount'],
			"vegPrice" => $_POST['vegPrice'],
			"vegUnit" => $_POST['unit'],
			"vegImg" => $imageFullDirection
		);
		$add = $veg->add($vegetable);
		if($add != false){
			move_uploaded_file($_FILES["vegImage"]["tmp_name"], $imageFullDirection);
			$alert = "Done.";
			echo 	'<script type="text/javascript">
						alert("'.$alert.'")
						window.location="new.php"
					</script>';
			unset($_SESSION['tmpValue']);
			unset($_SESSION['error']);
		}
		else{
			$alert = "Something wrong.";
			echo 	'<script type="text/javascript">
						alert("'.$alert.'")
						window.location="new.php"
					</script>';
		}
	}
?>