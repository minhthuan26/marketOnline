<?php  
	include "../connection.php";
	include "../class/category.php";
	include "../class/vegetable.php";
	include "../class/order.php";
	include "../session.php";
	Session::checkSession();
	$db = new Connection();
	$or = new Order();

?>
<!DOCTYPE html>
<html lang="en"D>
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
										echo 	"<li class='nav-item'><a class='nav-link menu-item item-name active' href='#'>History</a></li>";
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
				<h1>History</h1>
			</div>
			<div class="row">
				<table class="col-lg-12 col-cl-12" border='1'>
					<tr id="title" class="">
						<td class="col-lg-1 col-xl-1"><h5>#</h5></td>
						<td class="col-lg-4 col-xl-4"><h5>Date</h5></td>
						<td class="col-lg-4 col-xl-4"><h5>Total</h5></td>
						<td class="col-lg-3 col-xl-3"><h5>Detail</h5></td>
							
					</tr>
					<?php  
						$order = $or->getAllOrder($_SESSION['userID']);
						$stt = 0;
						while($values = mysqli_fetch_array($order)){
							$date = $values['Date'];
							$total = $values['Total'];
							$orderID = $values['OrderID'];
							$stt++;
							echo 	"<tr>";
							echo 		"<td class='col-lg-1 col-xl-1'>$stt</td>";
							echo 		"<td class='col-lg-4 col-xl-4'>$date</td>";
							echo 		"<td class='col-lg-4 col-xl-4'>$total VND</td>";
							echo 		"<td class='col-lg-3 col-xl-3'><a href='detail.php?ID=$orderID&total=$total' class='buy-button btn btn-outline-success btn-block '>Detail</a></td>";
							echo 	"</tr>";
						}
					?>
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
		a:hover, button:hover{
			transition: 0.8s;
		}

	</style>
	
</body>
</html>