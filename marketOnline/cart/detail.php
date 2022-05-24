<?php  
	include "../connection.php";
	include "../class/category.php";
	include "../class/vegetable.php";
	include "../class/order.php";
	include "../session.php";
	Session::checkSession();
	$db = new Connection();
	$or = new Order();
	$veg = new Vegetable();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
	<script src="../js/bootstrap.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div>
			<nav class="nav nav-tabs navbar-dark bg-dark navbar-expand-md">
				<div class="row container-fluid p-4">
					<a id="logo" class="navbar-brand col-9 col-sm-9 col-md-3 col-lg-4 col-xl-3" href="../index.php">Market online<a>
					<button id="menu-button" class="navbar-toggler mt-3" type="button" data-toggle="collapse" data-target="#menu">
					     <span class="navbar-toggler-icon"></span>
					</button>
					<div id="menu" class="collapse navbar-collapse col-lg-7 col-xl-9">
						 <ul class="nav nav-justified ml-auto col-3 col-sm-3 col-md-9 col-lg-12 col-xl-12">
							<li class="nav-item"><a class="nav-link menu-item item-name" href="../vegetable/">Vegetable</a></li>
							<li class="nav-item"><a class="nav-link menu-item item-name" href="index.php">Cart</a></li>
							<?php  
								if(isset($_SESSION['login']) && $_SESSION['login'] == true){
									$userName = Session::get('userName');
									if($userName != false){
										echo 	"<li class='nav-item'><a class='nav-link menu-item item-name ' href='history.php'>History</a></li>";
										echo 	"<li class='nav-item'><a class='user-name nav-link menu-item ite' href='#'>$userName</a></li>";
										echo 	"<li class='nav-item'><a class='nav-link menu-item item-name' href='../customer/logout.php?action=logout'>Logout</a></li>";
									}
								}
								else{
									echo 	"<li class='nav-item'><a class='nav-link menu-item item-name active' href='history.php' >History</a></li>";
									echo 	"<li class='nav-item'><a class='nav-link menu-item item-name' href='../customer/login.php'>Login</a></li>";
								}
								
							?>	
						</ul>
					</div>
					   
				</div>
			</nav>
		</div>
		<div class="pt-5 container">
			<div class="row mb-1">
				<h1>Detail</h1>
			</div>
			<div class="row">
				<table class="col-lg-12 col-cl-12" border='1'>
					<tr id="title" class="">
						<td class="col-lg-1 col-xl-1"><h5>#</h5></td>
						<td class="col-lg-4 col-xl-4"><h5>Name</h5></td>
						<td class="col-lg-4 col-xl-4"><h5>Image</h5></td>
						<td class="col-lg-1 col-xl-1"><h5>Amount</h5></td>
						<td class="col-lg-5 col-xl-5"><h5>Price</h5></td>
					</tr>
					<?php
						$stt = 0;
						$allAmount = 0;
						if(isset($_GET['ID'])){
							$orderID = $_GET['ID'];
							$total = $_GET['total'];
							$details = $or->getOrderDetail($orderID);
							while($values = mysqli_fetch_array($details)){
								$vegID = $values['VegetableID'];
								$vegDetail = $veg->getByID($vegID);
								while($vegValues = mysqli_fetch_array($vegDetail)){
									$vegName = $vegValues['VegetableName'];
									$vegImg = $vegValues['Image'];
									$vegAmount = $values['Quantity'];
									$allAmount += $vegAmount;
									$vegPrice = $vegValues['Price'];
									$stt++;
									echo 	"<tr>";
									echo 		"<td class='col-lg-1 col-xl-1'>$stt</td>";
									echo 		"<td class='col-lg-4 col-xl-4'>$vegName</td>";
									echo 		"<td class='col-lg-4 col-xl-4'><img class='img-fluid img-height' src='$vegImg'></td>";
									echo 		"<td class='col-lg-1 col-xl-1'>$vegAmount</td>";
									echo 		"<td class='col-lg-5 col-xl-5'>$vegPrice</td>";
									echo 	"</tr>";

								}
							}
						}
					?>
					<tr>
						<td colspan="3">Total:</td>
						<td colspan="1"><?php echo $allAmount; ?></td>
						<td colspan="1"><?php echo $total.' VND'; ?></td>
					</tr>
				</table>
			</div>
			
		</div>
		
	</div>

	<style type="text/css">
		#logo, #menu{
			float: left;
		}
		.menu-item{
			color: rgb(108 117 125);
			
		}
		.col-3 > ul > li > a, .col-sm-3 > ul > li > a{
			text-align: left;
		}
		.menu-item:hover{
			color: white;
			transition: 0.8s;
		}
		.navbar-brand{
			color: white;
			font-size: 36px;
			text-align: center;
		}
		.user-name{
			background-color: #2172ff;
			color: white;
		}
		.item-name{
			color: #a6a6a6;
		}
		table{
			text-align: center;
		}
		.img-height{
			height: 120px;
		}
		

	</style>
	
</body>
</html>