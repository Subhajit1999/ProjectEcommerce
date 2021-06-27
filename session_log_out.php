<?php
	session_start();
    setcookie("firsttime", "yes", /* EXPIRE */);
	session_destroy();

	header( "location:index.php" );

?>
