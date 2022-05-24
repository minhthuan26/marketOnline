<?php  
	include "../connection.php";
	include "../class/category.php";
	include "../class/vegetable.php";
	include "../class/customer.php";
	include "../session.php";
	Session::checkSession();

	$veg = new Vegetable();
	$cate = new Category();

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
			<?php include "menu.php" ?>
		</div>
		<div class="pt-5 container">
			<div class="row mb-1">
				<h1>Your Cart</h1>
			</div>
			<div class="row">
				<form class="col-lg-12 col-xl-12 " method="post" action="saveOrder.php?action=order&ID=<?php ?>">
					<table  border="1">
						<tr id="title" class="">
							<td class="col-lg-1 col-xl-1"><h5>#</h5></td>
							<td class="col-lg-4 col-xl-4"><h5>Name</h5></td>
							<td class="col-lg-4 col-xl-4"><h5>Image</h5></td>
							<td class="col-lg-1 col-xl-1"><h5>Quantity</h5></td>
							<td class="col-lg-2 col-xl-2"><h5>Price</h5></td>
							
						</tr>
						<?php
							if(!isset($_SESSION['cart'])){
								Session::set("cart", array());
							}
							if(isset($_GET['action']) == 'add' && isset($_POST['quan'])){
								foreach($_POST['quan'] as $ID => $quantity)
									$_SESSION['cart'][$ID] = $quantity;
							}
							$stt = 0;
							$total = 0;
							$allAmount = 0;
							foreach($_SESSION['cart'] as $ID => $quantity){
								
								if($quantity > 0){
									$allAmount += $quantity;
									if(!isset($_SESSION['price']))
										Session::set("price", array());
									$stt++;
									$vegSelected = $veg->getByID($ID);

									while($values = mysqli_fetch_array($vegSelected)){
										$vegName = $values['VegetableName'];
											$vegImage = $values['Image'];
											$vegQuantity = $quantity;
											$vegPrice = $values['Price']*$quantity;
											$total += $vegPrice;
											$_SESSION['price'][$ID] = $vegPrice;
											echo 	"<tr class=''>";
											echo 		"<td class='col-lg-1 col-xl-1'>$stt</td>";
											echo 		"<td class='col-lg-4 col-xl-4'>$vegName</td>";
											echo 		"<td class='col-lg-4 col-xl-4'><img class='img-fluid img-height' src='$vegImage'></td>";
											echo 		"<td class='col-lg-1 col-xl-1'>$vegQuantity</td>";
											echo 		"<td class='col-lg-2 col-xl-2'>$vegPrice</td>";
											echo 	"</tr>";
											
									}
								}
								else{
									$_SESSION['price'][$ID] = 0;
									$total = 0;
									$allAmount = 0;
								}
							}
							

						?>
						<tr>
							<td colspan="3"><h5>Total</h5></td>
							<td colspan='1'><?php echo $allAmount; ?></td>
							<td colspan='1' ><h5><?php echo $total; ?> VND</h5></td>
						</tr>

						<tr>
							<td><h5>Note</h5></td>
							<td colspan='5' class='img-height' ><textarea name='note' class='note-height col-lg-11 col-xl-11'></textarea></td>
						</tr>
						<tr class="">
							<td colspan='5' >
								<a class='buy-button btn btn-outline-success btn-block ' href="../vegetable/index.php?action=back">Continue</a>
								<button name="order-button" type="submit" class='buy-button btn btn-outline-danger btn-block' >Order</button>
							</td>
						
						</tr>
					</table>
				</form>
			</div>
			
		</div>
		
	</div>

	<style type="text/css">
		#title{
			text-align: center;
		}
		.img-height{
			height: 120px;
		}
		.note-height{
			height: 130px;
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