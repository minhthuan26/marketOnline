

<nav class="nav nav-tabs navbar-dark bg-dark navbar-expand-md">
	<div class="row container-fluid p-4">
		<a id="logo" class="navbar-brand col-9 col-sm-9 col-md-3 col-lg-4 col-xl-3" href="../index.php">Market online<a>
		<button id="menu-button" class="navbar-toggler mt-3" type="button" data-toggle="collapse" data-target="#menu">
		     <span class="navbar-toggler-icon"></span>
		</button>
		<div id="menu" class="collapse navbar-collapse col-lg-7 col-xl-9">
			 <ul class="nav nav-justified ml-auto col-3 col-sm-3 col-md-9 col-lg-12 col-xl-12">
				<li class="nav-item"><a class="nav-link menu-item item-name" href="../vegetable/">Vegetable</a></li>
				<li class="nav-item"><a class="nav-link menu-item item-name active" href="#">Cart</a></li>
				<?php  
					if(isset($_SESSION['login']) && $_SESSION['login'] == true){
						$userName = Session::get('userName');
						if($userName != false){
							echo 	"<li class='nav-item'><a class='nav-link menu-item item-name' href='history.php'>History</a></li>";
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

</style>
