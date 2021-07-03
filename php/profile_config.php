<?php
	if ( session_status() != PHP_SESSION_ACTIVE ) {
    session_start();
	}
	//Connecting to the DB
	$con = mysqli_connect( "localhost", "root", "", "shopyard" );

	// Getting cart, profile, address and cards data from user
	$user_sql = "select * from user where email='".$_SESSION['user']."'";

	// User data
	$user_res = mysqli_query( $con, $user_sql );
    $user_data = mysqli_fetch_array( $user_res );
	// Addresses data
	$addr_json = json_decode( $user_data['addresses'], true );
    $addr_arr = $addr_json != null? $addr_json['addrs']: array();
	// Cards data
	$card_json = json_decode( $user_data['cards'], true );
    $card_arr = $card_json != null? $card_json['cards']: array();
	// Cart data
	$cart_json = json_decode( $user_data['cart'], true );
    $cart_arr = $cart_json != null? $cart_json['items']: array();

	// Recent Orders
	$recent_sql = "SELECT * from orders WHERE cust_id='".$user_data['id']."' ORDER BY order_no DESC";
	$recent_res = mysqli_query($con, $recent_sql);
?>
