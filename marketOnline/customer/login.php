<?php  

	include "checkLogin.php";
	$class = new Login();
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login-button'])){
		$userID = $_POST['id-login'];
		$userPass = $_POST['password'];
		$loginCheck = $class->checkUser($userID, $userPass);
	}
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register-button'])){
		header('Location:register.php');
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script src="../js/bootstrap.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div id="left" class="col-sm-1 col-md-1 col-lg-2 col-xl-2"></div>

		<div id="content" class="col-sm-10 col-md-10 col-lg-8 col-xl-8">
			<?php 
				if(isset($loginCheck)){
					echo '<script type="text/javascript">alert("'.$loginCheck.'")</script>';
				}	
			?>
			<h1>Login</h1>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<form id="login-form" action="" method="post">
						<div class="form-group">
							<label class="form-label" for="id-login">Your ID: </label>
							<br>
							<br>
							<input type="text" name="id-login" placeholder="Please enter your ID...">
						</div>
						<div class="form-group">
							<label class="form-label" for="password">Password: </label>
							<br>
							<br>
							<input type="password" name="password" placeholder="Please enter your password...">
						</div>
						<div class="form-group">
							<button id="login-button" class="form-button" type="submit" name="login-button">Login</button>
							<button class="form-button" type="submit" name="register-button">Register</button>
							
						</div>
					</form>
				</div>
			</div>

		</div>
		<div id="right" class="col-sm-1 col-md-1 col-lg-2 col-xl-2"></div>
	</div>
	

	<style type="text/css">
		#content{
			margin-top: 10%;
			border: 2px solid #19ffba;
			display: block;
			float: left;
			box-shadow: 0 0 10px 5px black;
			background-color: #f2f2f2;
			
		}
		#content h1{
			text-align: center;
			font-size: 40px;
		}
		#right, #left{
			float: left;
		}
		.form-group{
			display: inherit;
			float: left;
			width: 70%;
			/*font-size: 24px;*/
			margin: 2% 0 2% 35%;
		}
		input{
			/*font-size: 24px;*/
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
		#login-button{
			margin-left: 15px;
		}
		#login-form{
			margin-left: 5%;
		}
	</style>
</body>
</html>