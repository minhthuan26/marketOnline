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
	<title>Add Category</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
	<script src="../js/bootstrap.js"></script>
</head>
<body>
	<div id="wrap" class="container-fluid">
		<div id="main" class="row pt-5">
			<div class="col-lg-4 col-xl-4">
				<form id="add-new" class="col-lg-4 col-xl-4" method="post" action="add.php">
					<div class="mb-2 col-lg-12 col-xl-12">
						<label class="row" for="cate-name">Name: </label>
						<input class="row col-lg-12 col-xl-12" type="text" name="cate-name">
					</div>
					<div class="mb-2 col-lg-12 col-xl-12">
						<label class="row" for="description">Description: </label>
						<input class="row col-lg-12 col-xl-12" type="text" name="description">
					</div>
					<div class="mb-2 col-lg-12 col-xl-12">
						<button class="row btn btn-outline-primary btn-block">ADD</button>
					</div>
				</form>
			</div>

			<div id="content" class="col-lg-8 col-xl-8">
				<div class="row col-lg-12 col-xl-12">
					<h1 class="ml-2">Category</h1>
				</div>

				<div id="list" class="row col-lg-12 col-xl-12">
					<table border="1" class="col-lg-12 col-xl-12">
						<tr id='title'>
							<td class="col-lg-1 col-xl-1"><h5>#</h5></td>
							<td class="col-lg-3 col-xl-3"><h5>Name</h5></td>
							<td class="col-lg-8 col-xl-8"><h5>Description</h5></td>
						</tr>
						<?php 
							$stt = 0;
							$cate = new Category();
							$cateList = $cate->getAll();
							while($values = mysqli_fetch_array($cateList)){
								$name = $values['Name'];
								$des = $values['Description'];
								$stt++;
								echo 	"<tr>";
								echo 		"<td id='stt' class='col-lg-1 col-xl-1'>$stt</td>";
								echo 		"<td class='col-lg-3 col-xl-3'>$name</td>";
								echo 		"<td class='col-lg-8 col-xl-8'>$des</td>";
								echo 	"</tr>";
							}
						?>
					</table>
				</div>
			</div>
		</div>
		
	</div>

	<style type="text/css">
		#add-new{
			position: fixed;
			margin-top: 2%;
		}
		#list{
			margin-top: 1%;
		}

		#title, #stt{
			text-align: center;
		}
		button:hover{
			transition: 0.8s;
		}


	</style>

</body>
</html>