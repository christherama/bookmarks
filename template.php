<!DOCTYPE html>
<html>
	<head>
		<!-- FAVICON -->
		<link rel="icon" type="image/png" href="assets/img/bookmark-icon.png" />
	
		<!-- BOOTSTRAP CSS -->
		<link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
		<!-- <link rel="stylesheet" type="text/css" href="vendors/bootstrap/css/bootstrap-responsive.min.css" /> -->
		
		<!-- GOOGLE WEB FONTS -->
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Chau+Philomene+One" />
		
		<!-- OUR CSS -->
		<link rel="stylesheet" type="text/css" href="assets/styles.css" />
		
		<!-- JQUERY/BOOTSTRAP JAVASCRIPT -->
		<script type="text/javascript" src="assets/vendors/bootstrap/js/jquery.min.js" ></script>
		<script type="text/javascript" src="assets/vendors/bootstrap/js/bootstrap.min.js" ></script>
		
		<!-- OUR JAVASCRIPT -->
		<script type="text/javascript" src="assets/bookmarks.js" ></script>
		
		<title>Bookmarks</title>
	</head>
	<body>
		<header>
			<?php include('layout/header.php') ?>
		</header>
		<nav class="navbar navbar-fixed-top">
			<?php include('layout/nav.php') ?>
		</nav>
		<div class="container">
			<div id="main">
				<?php include('layout/main.php') ?>
			</div>
			<footer>
				<?php include('layout/footer.php') ?>
			</footer>
		</div>
	</body>
</html>