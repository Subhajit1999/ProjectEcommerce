<?php
	if ( session_status() != PHP_SESSION_ACTIVE ) {
    	session_start();
	}
//    echo "<script>alert('".$_SESSION['user']."');</script>";
	if(!isset($_SESSION['user'])) {
		//User not logged in
		header('location: /ecommerce/auth.php?src=cart');
	} else {
		// User logged in
		header('location: /ecommerce/cart.php');
	}
?>
