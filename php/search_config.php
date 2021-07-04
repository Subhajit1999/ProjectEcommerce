<?php
	if ( ( $_SERVER['REQUEST_METHOD'] == 'POST' ) and ( isset( $_POST['search-btn'] ) ) ) {
		$term = $_REQUEST['search'];
		// Redirect to search page by setting url param
		header("location:../search.php?term=".$term);
	}
?>
