<?php 
	include "connection.php";
	include "class/customer.php";
	include "session.php";
	Session::init();

	if(isset($_GET['action'])){
		if($_GET['action'] == 'logout');
		Session::destroy();
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Market online</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
	<script src="js/bootstrap.js"></script>

</head>
<body>
	<div class="container-fluid">
		<div id="header">
			<?php include "menu.php" ?>
		</div>
	</div>

</body>
</html>