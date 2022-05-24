<?php
	include "../class/vegetable.php";
	include "../class/category.php";
	include "../class/order.php";
	include "../class/customer.php";
	include "../connection.php";
	include "../session.php";
	Session::checkSession();
	$veg = new Vegetable();
	$cate = new Category();
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add Vegetable</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
	<script src="../js/bootstrap.js"></script>
</head>
<body>
	<div class="container">
		<div class=" col-lg-12 col-xl-12 mt-5">
			<h1>Add Vegetable</h1>
		</div>
		<?php 
			if(!isset($_SESSION['error']))
				$_SESSION['error'] = array(
					"errorName" => "",
					"errorAmount" => "", 
					"errorPrice" => "",
					"errorImage" => ""
				);
			if(!isset($_SESSION['tmpValue']))
				$_SESSION['tmpValue'] = array(
					"valueName" => "",
					"valueAmount" => "", 
					"valuePrice" => "",
					"valueImage" => ""
				);
		?>
		<div class="col-lg-12 col-xl-12 mt-5">
			<form name="form" class="col-lg-12 col-xl-12" enctype="multipart/form-data" method="post" action="add.php">
				<div class="row">
					<div class="form-group col-lg-6 col-xl-6 float-left mt-3">
						<label for="vegName" class="row">Vegetable Name:</label>
						<input type="text" name="vegName" class="row col-lg-12 col-xl-12 form-control" value="<?php echo $_SESSION['tmpValue']['valueName']; ?>">
						<span class="row col-lg-12 col-xl-12 error"><?php echo $_SESSION['error']['errorName']; ?></span>
					</div>
					
					<div class="form-group col-lg-6 col-xl-6 float-left mt-3">
						<label for="category" class="row">Category:</label>
						<select class="form-control" id="category" name="category">
					<?php  
						$cateList = $cate->getAll();
						while($values = mysqli_fetch_array($cateList)){
							$name = $values['Name'];
					?>
						    <option><?php echo $name; ?></option>
					<?php  
						}
					?>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-lg-3 col-xl-3 float-left mt-3">
						<label for="amount" class="row">Amount:</label>
						<input type="text" name="vegAmount" class="row col-lg-12 col-xl-12 form-control" value="<?php echo $_SESSION['tmpValue']['valueAmount']; ?>">
						<span class="row col-lg-12 col-xl-12 error"><?php echo $_SESSION['error']['errorAmount']; ?></span>
					</div>

					<div class="form-group col-lg-3 col-xl-3 float-left mt-3">
						<label for="price" class="row">Price:</label>
						<input type="text" name="vegPrice" class="row col-lg-12 col-xl-12 form-control" value="<?php echo $_SESSION['tmpValue']['valuePrice']; ?>">
						<span class="row col-lg-12 col-xl-12 error"><?php echo $_SESSION['error']['errorPrice']; ?></span>
					</div>

					<div class="form-group col-lg-6 col-xl-6 float-left mt-3">
						<label for="unit" class="row">Unit:</label>
						<select class="form-control" id="vegUnit" name="unit">
					<?php  
						$vegList = $veg->getAll();
						$unitArray = array();
						while($values = mysqli_fetch_array($vegList)){
							$unit = $values['Unit'];
							$tmp = 0;
							if(sizeof($unitArray) == 0)
								array_push($unitArray, $unit);
							for($i=0; $i<sizeof($unitArray); $i++){
								if($unit == $unitArray[$i])
									$tmp++;
							}
							if($tmp == 0)
								array_push($unitArray, $unit);

						}
						foreach($unitArray as $unit){
					?>
						    <option><?php echo $unit; ?></option>
					<?php  
						}
					?>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-lg-6 col-xl-6 float-left mt-3">
						<label for="image" class="row">Image:</label>
						<input type="file" name="vegImage" class="row col-lg-12 col-xl-12 form-control">
						<span class="row col-lg-12 col-xl-12 error"><?php echo $_SESSION['error']['errorImage']; ?></span>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-lg-12 col-xl-12 float-left mt-3">
						<button type="submit" name="submit" class="row btn btn-outline-primary btn-block form-control">ADD</button>
					</div>
				</div>
				
			</form>
		</div>

		<?php  
			
		?>

	</div>
	<style type="text/css">
		.error{
			color: red;
		}
	</style>

</body>
</html>