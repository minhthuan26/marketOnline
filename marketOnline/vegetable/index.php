<?php  
	include "../class/vegetable.php";
	include "../class/category.php";
	include "../class/order.php";
	include "../class/customer.php";
	include "../connection.php";
	include "../session.php";
	Session::checkSession();
	$veg = new Vegetable();


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vegetable</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
	<script src="../js/bootstrap.js"></script>
</head>
<body>
	<div id="wrap" class="container-fluid">
		<div id="header">
			<?php include "menu.php"; ?>
		</div>
		<div id="main" class="row pt-5">
			<div class="col-lg-3 col-xl-3 ">
				<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 Category float-left">
					<div class="row col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<h5 class="">Vegetable Category:</h5>
					</div>

					<div class="row">
						<form action="" method="get" class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<?php  
								$cate = new Category();
								$cateItems = $cate->getAll();
								$cateArray = array();
								while($cateValues = mysqli_fetch_array($cateItems)){
									$cateName = $cateValues['Name'];
									$cateID = $cateValues['CategoryID'];
									array_push($cateArray, $cateID);
									echo 	"<div class='form-group'>";
									echo		"<input class='form-check-input float-right' type='checkbox' name='$cateID' value='$cateID'>";
									echo 		"<label class='form-check-label' for='$cateName'>$cateName</label>";	
									echo 	"</div>";
									
								}
							?>
							<button id='filter-button' name='filter' type='submit' class='btn btn-outline-primary btn-block'>FILTER</button>
						</form>
					</div>
				</div>

			</div>
			<div id="content" class="col-lg-9 col-xl-9">
				<div class="row col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<h1 class="ml-4">Vegetable</h1>
				</div>

				<div id="list" class="row col-sm-12 col-md-12 col-lg-12 col-xl-12">
						
					
					<?php 
								
					$vegItems = $veg->getAll();
						$cateids = array();
						$quantity = array();
						for($i=0; $i<sizeof($cateArray); $i++){
							$tmp = array(
								"$cateArray[$i]" => 0
							);
							array_push($quantity, $tmp);
						}
							
						if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['filter'])){
							for ($i=0; $i < sizeof($cateArray); $i++) { 
								if(isset($_GET[$cateArray[$i]]))
								array_push($cateids, $_GET[$cateArray[$i]]);
							}
							if(count($cateids)>0){
								$filterVegItems = $veg->getListByCateIDs($cateids);
									
								for ($i=0; $i <sizeof($filterVegItems) ; $i++){
										
									while($filterVegValues = mysqli_fetch_array($filterVegItems[$i])){

										$img = $filterVegValues['Image'];
										$name = $filterVegValues['VegetableName'];
										$price = $filterVegValues['Price'];
										$vegID = $filterVegValues['VegetableID'];
										$vegAmount = $filterVegValues['Amount'];
										$vegUnit = $filterVegValues['Unit'];
										$vegSelectedValues = 0;
										if(isset($_SESSION['cart'])){
											foreach ($_SESSION['cart'] as $ID => $quantity) {
												if($ID == $vegID)
													$vegSelectedValues = $quantity; 
											}
										}
											
										echo 	"<div class='col-lg-4 col-xl-4 p-5'>";
										echo 		"<div class='row mb-1'>";
										echo 			"<img class='img-fluid img-height' src=".$img.">";
										echo		"</div>";
												
										echo		"<div class='row mb-1'>";
										echo			"<h5 class='col-lg-5 col-xl-5 veg-name'>$name</h5>";
										echo			"<span class='p-1 d-block text-white bg-danger rounded col-lg-7 col-xl-7 veg-price'>";
										echo 				$price." VND / 1".$vegUnit;
										echo			"</span>";
										echo		"</div>";
										echo 		"<form action='../cart/index.php?action=add&ID=$vegID' class='mb-1' method='post'>";
										echo 			"<div class='row'>";
										echo 				"<label for='$vegID' class='quantity col-lg-3 col-xl-3'>Quantity: </label>";
										echo 				"<input class='mb-1 col-lg-9 col-xl-9' type='number' min='0' max='$vegAmount' name='quan[$vegID]' class='col-lg-6 col-xl-6' value='$vegSelectedValues'>";
										echo				"<button name='buy' type='submit' class='buy-button btn btn-outline-success btn-block' value='$vegID'>BUY</button>";
										echo 			"</div>";
										echo		"</form>";
										echo 	"</div>";
											
									}
										
								}
							}
							else{
								goto filter0;
							}
								
						}
						
						else{
							filter0:
							while($vegValues = mysqli_fetch_array($vegItems)){
								$img = $vegValues['Image'];
								$name = $vegValues['VegetableName'];
								$price = $vegValues['Price'];
								$vegID = $vegValues['VegetableID'];
								$vegAmount = $vegValues['Amount'];
								$vegUnit = $vegValues['Unit'];
								$vegSelectedValues = 0;
								if(isset($_SESSION['cart'])){
									foreach ($_SESSION['cart'] as $ID => $quantity) {
										if($ID == $vegID)
											$vegSelectedValues = $quantity; 
									}
								}
								echo 	"<div class='col-lg-4 col-xl-4 p-5'>";
								echo 		"<div class='row mb-1'>";
								echo 			"<img class='img-fluid img-height' src=".$img.">";
								echo		"</div>";
										
								echo		"<div class='row mb-1'>";
								echo			"<span class='col-lg-5 col-xl-5 veg-name'><h5>$name</h5></span>";
								echo			"<span class='p-1 d-block text-white bg-danger rounded col-lg-7 col-xl-7 veg-price'>";
								echo 				$price." VND / 1".$vegUnit;
								echo			"</span>";
								echo		"</div>";
								echo 		"<form action='../cart/index.php?action=add&ID=$vegID' class='mb-1' method='post'>";
								echo 			"<div class='row'>";
								echo 				"<label for='$vegID' class='quantity col-lg-3 col-xl-3'>Quantity: </label>";
								echo 				"<input class='mb-1 col-lg-9 col-xl-9' type='number' min='0' max='$vegAmount' name='quan[$vegID]' class='col-lg-6 col-xl-6' value='$vegSelectedValues'>";
								echo				"<button name='buy' type='submit' class='buy-button btn btn-outline-success btn-block' value='$vegID'>BUY</button>";
								echo 			"</div>";
								echo		"</form>";
								echo 	"</div>";
										
							}
						}

					?>
				</div>
			</div>
		</div>
		
	</div>

	<style type="text/css">
		#wrap, #content{
			float: left;
		}
		.img-height{
			height: 350px;
		}
		#filter-button, .buy-button{
			transition: 0.8s;
		}
		#list a{
			text-decoration: none;
			width: 100%;
		}
		input{
			text-align: center;
		}
		.Category{
			margin-top: 15%;
			margin-left: 4%;
			position: fixed;
		}
		.quantity{
			text-align: left;
			padding: 0;
		}
		.veg-name{
			text-align: left;
			padding: 0;
		}
		.veg-price{
			text-align: center;
		}

	</style>

</body>
</html>