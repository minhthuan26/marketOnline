<?php  

	include "saveRegister.php";
	$regist = new Register();
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login-button'])){
		header('Location:login.php');
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register-button'])){
		$customer = array(
			"Fullname" => $_POST['fullname'],
			"Password" => $_POST['password'],
			"Address" => $_POST['address'],
			"City" => $_POST['city']
		);
		$registerCheck = $regist->addRegister($customer);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script src="../js/bootstrap.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div id="left" class="col-sm-1 col-md-1 col-lg-2 col-xl-2"></div>

		<div id="content" class="col-sm-10 col-md-10 col-lg-8 col-xl-8">
			<?php 
				if(isset($registerCheck)){
					echo '<script type="text/javascript">var tmp = confirm("'.$registerCheck.'")
						if(tmp == true) window.location="login.php"
						else window.location="login.php"
					</script>';
				}	
			?>
			<h1>Register</h1>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<form id="login-form" action="" method="post">
						<div class="form-group">
							<label class="form-label" for="fullname">Your fullname: </label>
							<br>
							<br>
							<input type="text" name="fullname" placeholder="Please enter your fullname...">
						</div>
						<div class="form-group">
							<label class="form-label" for="password">Password: </label>
							<br>
							<br>
							<input type="password" name="password" placeholder="Please enter your password...">
						</div>
						<div class="form-group">
							<label class="form-label" for="address">Address: </label>
							<br>
							<br>
							<input type="text" name="address" placeholder="Please enter your address...">
						</div>
						<div class="form-group">
							<label class="form-label" for="city">City: </label>
							<br>
							<br>
							<input type="text" name="city" placeholder="Please enter your city...">
						</div>
						<div class="form-group">
							<button id="register-button" class="form-button" type="submit" name="register-button">Register</button>
							<button id="login-button" class="form-button" type="submit" name="login-button">Login</button>
						</div>
					</form>
				</div>
				
			</div>
			
		</div>

		<div id="right" class="col-sm-1 col-md-1 col-lg-2 col-xl-2"></div>
	</div>
	

	<style type="text/css">
		#content{
			margin-top: 3%;
			border: 2px solid #19ffba;
			display: block;
			float: left;
			box-shadow: 0 0 10px 5px black;
			background-color: #f2f2f2;
			
		}
		#right, #left{
			float: left;
		}
		#content h1{
			text-align: center;
			font-size: 40px;
		}
		.form-group{
			display: inherit;
			float: left;
			width: 70%;
			font-size: 24px;
			margin: 1% 0 1% 15%;
		}
		input{
			font-size: 24px;
			width: 100%;
			height: 40px;
			border-radius: 10px;
		}
		button{
			font-size: 36px;
			background-color: #00d3de;
			color: white;
			border-radius: 10px;
			border-color: white;
			float: right;
			transition: 0.8s;
		}
		button:hover{
			transform: scale(1.08);
			cursor: pointer;
		}
		#register-button{
			margin-left: 15px;
		}
	</style>

</body>
</html>