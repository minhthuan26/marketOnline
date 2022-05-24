<?php  
	include "../connection.php";
	include "../class/order.php";
	include "../class/vegetable.php";
	include "../session.php";
	Session::checkSession();
	$db = new Connection();
	$or = new Order();
	$veg = new Vegetable();
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order-button'])){
		$total = 0;
		foreach($_SESSION['price'] as $ID => $price){
			$total += $price;
		}
		if($total > 0){
			$today = date("Y-m-d");
			$order = array(
				"cusID" => $_SESSION['userID'],
				"Date" => $today,
				"Total" => $total,
				"note" => $_POST['note']
			);
			$result1 = $or->addOrder($order);
			if($result1 != false){

				foreach($_SESSION['price'] as $ID => $price){
					$detail = array(
						"orderID" => $result1,
						"vegID" => $ID,
						"Quantity" => $_SESSION['cart'][$ID],
						"Price" => $price
					);
					$or->addDetail($detail);
					$vegSelected = $veg->getByID($ID);
					while ($values = mysqli_fetch_array($vegSelected)){
						$vegAmountRemain = $values['Amount'] - $_SESSION['cart'][$ID];
						$query = "UPDATE vegetable SET Amount='$vegAmountRemain' WHERE VegetableID='$ID'";
						$result2 = $db->update($query);
					}
				}
				unset($_SESSION['price']);
				unset($_SESSION['cart']);
				echo 	'<script type="text/javascript">var tmp = confirm("Done.")
						if(tmp == true) window.location="../index.php"
						else window.location="../index.php"
						</script>';
			}
		}
		else{
			echo 	'<script type="text/javascript">var tmp = confirm("Done.")
						if(tmp == true) window.location="../index.php"
							else window.location="../index.php"
						</script>';
		}
	}	

?>