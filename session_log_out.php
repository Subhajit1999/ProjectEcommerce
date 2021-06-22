<?php
	session_start();
    setcookie("firsttime", "yes", /* EXPIRE */);
	session_destroy();

//	$_SESSION['toast_title'] = "Success!";
//	$_SESSION['toast_msg'] = "You are now logged out. come back soon.";
//	$_SESSION['toast_type'] = "success";
	header( "location:index.php" );

?>
