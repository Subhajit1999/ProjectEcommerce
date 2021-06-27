<?php
	if(session_status()!=PHP_SESSION_ACTIVE) {
		session_start();
	}
	$url = "http://";
    $url.= $_SERVER['HTTP_HOST'];
    $url.= $_SERVER['REQUEST_URI'];

	//Extracting the url params, if any
	$url_components = parse_url($url);
	$params = array();
	if(array_key_exists('query',$url_components)) {
		parse_str($url_components['query'], $params);
	}

$email = "";
if (!isset($_COOKIE['firsttime']) or $_COOKIE['firsttime'] == "yes"){ // User not logged in
    	setcookie("firsttime", "yes", /* EXPIRE */);
	}else {                                          // User logged in
  		if($_SESSION['user']=="") { // If email not exists or session expires
        	header("location:auth.php");
     	}
   		$email=$_SESSION['user'];
	}

	if(isset($_COOKIE['show-toast']) and $_COOKIE['show-toast']=='yes') {
		setcookie('show-toast','',time()-1000);
		require_once 'common/toast.php';
	}
?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Bootstrap library css cdn-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<!--Font Awesome library for all the modern project icons-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--Bootstrap js library cdn-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

	<!-- StyleSheets -->
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/toast.css">
</head>

<body>
	<div class="top-nav-bar">

		<!--Toolbar-->
		<div class="toolbar">
			<i class="fa fa-bars" id="menu-btn" onclick="openSideNav()"></i>

			<div class="logo-container">
				<a href="index.php"><img src="img/brand-logo.png" class="brand-logo"></a>
			</div>
			<!--Search Bar-->
			<div class="search-bar">
				<!-- TODO: <a> tag temporary -->
				<form action="/ecommerce/php/search_config.php" method="post">
					<input type="text" placeholder=" Search by Products or Categories" name="search">
					<button type="submit" name="search-btn">
						<i class="fa fa-search"></i>
					</button>
				</form>
			</div>
			<!-- Toolbar options-->
			<div class="nav-options">
				<ul>
					<?php
						// If user not logged in
						if (!isset($_COOKIE['firsttime']) or $_COOKIE['firsttime'] == "yes")
						{
 							echo "<li><a href=\"auth.php?src=main\">Login</a></li>";
						}else   // User logged in
						{
    						if ( $_SESSION['user'] == "" ) {
    							echo "<li><a href=\"auth.php?src=main\">Login</a></li>";
							}else{
								echo "<li><a href=\"profile.php\">Account</a></li>";
							}
						}
					?>
					<li><a href="cart.php"><i class="fa fa-shopping-cart"></i>Cart</a></li>
				</ul>
			</div>
		</div>

		<!--Categories Menu Bar-->
		<div id="cat-menu" class="nav-category-menu-bar">
			<a href="javascript:void(0)" id="close-btn" onclick="closeSideNav()">
				<i class="fa fa-times"></i>
			</a>
			<div id="cat-heading">Top Categories</div>
			<ul>
				<li><a href="#">Men<i class="fa fa-angle-down"></i></a>
					<ul>
						<li><a href="/ecommerce/category-products.php?cat_id=401">Topwear</a></li>
						<li><a href="/ecommerce/category-products.php?cat_id=402">Bottomwear</a></li>
						<li><a href="#">Footwear</a></li>
						<li><a href="/ecommerce/category-products.php?cat_id=404">Festive Wear</a></li>
						<li><a href="#">Watches</a></li>
						<li><a href="#">Accessories</a></li>
					</ul>
				</li>
				<li><a href="#">Women<i class="fa fa-angle-down"></i></a>
					<ul>
						<li><a href="#">Topwear</a></li>
						<li><a href="#">Bottomwear</a></li>
						<li><a href="/ecommerce/category-products.php?cat_id=409">Footwear</a></li>
						<li><a href="#">Festive Wear</a></li>
						<li><a href="#">Watches</a></li>
						<li><a href="#">Accessories</a></li>
					</ul>
				</li>
				<li><a href="#">Baby &amp;
						Kids<i class="fa fa-angle-down"></i></a>
					<ul>
						<li><a href="#">Boys Clothing</a></li>
						<li><a href="/ecommerce/category-products.php?cat_id=414">Girls Clothing</a></li>
						<li><a href="#">Boys Footwear</a></li>
						<li><a href="#">Girls Footwear</a></li>
						<li><a href="#">Kids Accessories</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</body>

</html>
