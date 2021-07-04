<!DOCTYPE html>
<html>

<head>
	<title>Search Products | ShopYard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Bootstrap library css cdn-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<!--Font Awesome library for all the modern project icons-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--Bootstrap js library cdn-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

	<style>
		.nothing-msg-container {
			width: 100%;
			text-align: center;
		}

		.button {
			width: 10%;
			text-align: center;
			height: 4rem;
			line-height: 4rem;
			background-color: orange;
			font-size: 1.6rem;
			color: white;
			text-decoration: none;
			border-radius: .5rem;
			display: inline-block;
			text-decoration: none !important;
			margin: 0 auto;
			margin-bottom: 10%;
		}

		.button:hover {
			background-color: orangered;
			color: white;
		}

	</style>
</head>

<body>
	<!-------- Header (Toolbar & Navigation Bar)------------>
	<?php
        include 'common/header.php'; ?>

	<!-- Main Body -->
	<section class="search-body">
		<div class="container">
			<div class="nothing-msg-container">
				<h1 style="text-align:center;font-size:30px;font-weight:bold;color:orangered;margin-top:10%;">Thank you!<span style='font-size:30px;'>&#128515;</span></h1>

				<h2 style="text-align:center;margin-bottom:5%;color:#3a3a3a;font-family: 'Satisfy', cursive;font-size:22px;">We are pleased to see that you liked and bought our products. Buy Again!</h2>

				<a class="button" href="index.php">Back to Home</a>
			</div>
		</div>
	</section>

	<!----------- Footer -------------->
	<?php
        include 'common/footer.html'; ?>

	<!-------------------------- JS Scripts ---------------------------------->
	<script src="js/nav-drawer.js"></script>
	<!------------------------------------------------------------------------>
</body>

</html>
