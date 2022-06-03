
<!DOCTYPE HTML>
<html>
	<head>
		<title>CTIIR6</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/util.js"></script>
	</head>
	<?php 
 // Init session
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 
 ?>
	<body class="is-preload">

		
			<div id="wrapper" class="fade-in">

				
					<div id="intro">
						<h1>CTIIR6</h1>
		
						<ul class="actions">
							<li><a href="#header" class="button icon solid solo fa-arrow-down scrolly">Continue</a></li>
						</ul>
					</div>

				
					<header id="header">
						<a href="index.html" class="logo">SITE DE TRANSPORT COMMUN</a>
					</header>

				
					<nav id="nav">
						<ul class="links">
							<?php if (isset($_SESSION["name"]) && !empty($_SESSION["name"]) && $_SESSION["name"]=="admin"){ ?>
							<li><a href="index.php">modif_trajet</a></li>
							<li><a href="horaire.php">modif_Les_horaires</a></li>
							<li><a href="tarifs.php">modif_tarifs</a></li>
							<li><a href="">complaints</a></li>
							<li><a href="map.php">manip_map</a></li>
						</ul>
						<ul class="icons">
							<li> <?php echo $_SESSION["name"] ;?>  </li>
							 
							 <a href='logout.php'> <button>logout </button></a>
							<?php }else { ?>
								<li><a href="index.php"> trajet</a></li>
							<li><a href="horaire.php">Les horaires</a></li>
							<li><a href="tarifs.php"> tarifs</a></li>
							<li><a href="contact.php">contact</a></li>
							<li><a href="map.php">la map</a></li>
						</ul>
						<ul class="icons">
							 <a href='login.php'> <button>login admin </button></a>
							 
							<?php } ?>
							 
							
						</ul>
					</nav>
					<!--this will be on each document-->
					</header>

					<div id="main">

						
									
								