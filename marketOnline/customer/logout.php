<?php 
	include "../session.php";
	Session::checkSession();

	if(isset($_GET['action'])){
		if($_GET['action'] == 'logout');
		Session::destroy();
	}

?>