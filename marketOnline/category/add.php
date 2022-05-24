<?php  
	include "../class/category.php";
	include "../connection.php";
	include "../session.php";
	Session::checkSession();
	$cate = new Category();
	if(isset($_POST)){
		$newCate = array(
			"Name" => $_POST['cate-name'],
			"Description" => $_POST['description']
		);
		$alert = $cate->add($newCate);
		echo 	'<script type="text/javascript">var tmp = alert("'.$alert.'")
						window.location="index.php"
				</script>';
	}
?>