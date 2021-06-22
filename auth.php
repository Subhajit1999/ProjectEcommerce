<?php // Connecting to the Authentication Service backend
include( 'php/auth_config.php' ) ?>

<!DOCTYPE html>
<html>

<head>
	<title>Login | ShopYard, the Fashion Store</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Bootstrap library css cdn-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<!--Font Awesome library for all the modern project icons-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--Bootstrap js library cdn-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

	<!-- StyleSheets -->
	<link rel="stylesheet" href="css/authpage.css">
</head>

<body>
	<!----------- Site logo & Options buttons ------------->
	<div class="logobar">
		<a href="index.php"><img src="img/brand-logo.png" class="brand-logo"></a>

		<div class="options">
			<ul>
				<li><a href="about.php">About Us</a></li>
				<li><a href="contact.php">Help</a></li>
			</ul>
		</div>
	</div>

	<!----------- Page Body ( Image & Forms ) ------------->
	<div class="auth-page">
		<div class="row">

			<!-- Image -->
			<div class="col" id="img-area">
				<img id="feature-img" src="img/auth-img.png" height="110%">
			</div>

			<!-- Forms -->
			<div class="col" id="form-area">
				<div class="quote-container">
					<h3><b>"Happiness is not in money,<br />but in shopping."</b></h3>
					<h4>-Marilyn Monroe</h4>
				</div>
				<div class="form-container">
					<div class="form-btn">
						<span onclick="login()">Login</span>
						<span onclick="register()">Register</span>
						<hr id="indicator">
					</div>

					<!-- Login Form -->
					<form method="post" id="login-form">

						<h4>Please enter your details to login.</h4>
						<input type="text" placeholder="john@example.com" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
						<input type="password" placeholder="Enter Password (min. 4 chars)" name="pass" pattern=".{4,}" required>
						<button type="submit" class="submit-btn" name="login_user">Login</button>
						<a href="#">Forgot password?</a>
					</form>

					<!-- Registration Form -->
					<form method="post" id="register-form" action="">

						<h4>Please provide your details to register.</h4>
						<input type="text" placeholder="Firstname (John)" name="first-name"  required>
						<input type="text" placeholder="Lastname (Smith)" name="last-name"  required>
						<input type="email" placeholder="john@example.com" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
						<input type="password" placeholder="Enter Password (min. 4 chars)" pattern=".{4,}" name="password" required>
						<button type="submit" class="submit-btn" name="reg_user">Register</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Attribution Footer -->
<!--
	<div id="auth-footer">
		<h6><i class="fa fa-copyright"></i><em>Copyright @2020.</em></h6>
		<p><em>All rights reserved. Designed by </em><b>RS Studio</b><br />
		</p>
	</div>
-->
	<?php include "common/footer.html" ?>

	<!----------- JS Scripts ------------->
	<script src="js/auth.js"></script>

</body>

</html>
