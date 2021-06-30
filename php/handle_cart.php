<?php
if ( session_status() != PHP_SESSION_ACTIVE ) {
    session_start();
}
	//Connecting to the DB
	$con = mysqli_connect( "localhost", "root", "", "shopyard" );

	// Getting cart & buy later data from user
	$user_sql = "select * from user where email='".$_SESSION['user']."'";
	$user_res = mysqli_query( $con, $user_sql );
    $user_data = mysqli_fetch_array( $user_res );

	$cart_json = json_decode( $user_data['cart'], true );
    $cart_arr = $cart_json != null? $cart_json['items']: array();

	$later_json = json_decode( $user_data['buy_later'], true );
    $later_arr = $later_json != null? $later_json['items']: array();

	//Price variables
	$bill_price = $saving = 0;

	// Get the current url
	$url = "http://";
	$url .= $_SERVER['HTTP_HOST'];
	$url .= $_SERVER['REQUEST_URI'];

	//Extracting the url params
	$url_components = parse_url( $url );
	if(array_key_exists('query', $url_components)) {
		parse_str( $url_components['query'], $params );
		$action = $params["action"];
		$item_id = $params["id"];
		$section = array_key_exists('section', $params)? $params['section'] : null;

		if($action == 'remove' and $section == 'cart') {  //Cart item remove
			foreach ( $cart_arr as $item ) {
        		if ( $item['id'] == $item_id ) {

					$index = array_search($item, $cart_arr);
            		unset($cart_arr[$index]);

					$cart_json['items'] = array_values($cart_arr);
        			$json = json_encode( $cart_json );
        			$cart_sql = "UPDATE `user` SET `cart`='".$json."' WHERE id='".$user_data['id']."'";
        			$cart_res = mysqli_query( $con, $cart_sql );

					$_SESSION['toast_title'] = "Success!";
					$_SESSION['toast_msg'] = "Product removed from Cart successfully.";
					$_SESSION['toast_type'] = "success";
					setcookie("show-toast", "yes", time()+1000,'/');

					header('location: ../cart.php');
        		}
    		}
		} elseif($action == 'remove' and $section == 'buy-later') {  // Buy Later item remove
			foreach ( $later_arr as $item ) {
        		if ( $item['id'] == $item_id ) {

					$index = array_search($item, $later_arr);
            		unset($later_arr[$index]);

					$later_json['items'] = array_values($later_arr);
        			$json = json_encode( $later_json );
        			$later_sql = "UPDATE `user` SET `buy_later`='".$json."' WHERE id='".$user_data['id']."'";
        			$later_res = mysqli_query( $con, $later_sql );

					$_SESSION['toast_title'] = "Success!";
					$_SESSION['toast_msg'] = "Product removed from Buy Later successfully.";
					$_SESSION['toast_type'] = "success";
					setcookie("show-toast", "yes", time()+1000,'/');

					header('location: ../cart.php');
        		}
    		}
		} elseif($action == 'buy-later') {
			foreach ( $cart_arr as $item ) {
        		if ( $item['id'] == $item_id ) {

					array_push( $later_arr, $item );
        			$later_json['items'] = array_values($later_arr);
        			$json_later = json_encode( $later_json );

					$index = array_search($item, $cart_arr);
            		unset($cart_arr[$index]);

					$cart_json['items'] = array_values($cart_arr);
        			$json_cart = json_encode( $cart_json );
        			$sql = "UPDATE `user` SET `cart`='".$json_cart."',`buy_later`='".$json_later."' WHERE id='".$user_data['id']."'";
        			$res = mysqli_query( $con, $sql );

					$_SESSION['toast_title'] = "Success!";
					$_SESSION['toast_msg'] = "Product added to Buy Later successfully.";
					$_SESSION['toast_type'] = "success";
					setcookie("show-toast", "yes", time()+1000,'/');

					header('location: ../cart.php');
        		}
    		}
		} elseif($action == 'move-to-cart') {
			foreach ( $later_arr as $item ) {
        		if ( $item['id'] == $item_id ) {

					array_push( $cart_arr, $item );
        			$cart_json['items'] = array_values($cart_arr);
        			$json_cart = json_encode( $cart_json );

					$index = array_search($item, $later_arr);
            		unset($later_arr[$index]);

					$later_json['items'] = array_values($later_arr);
        			$json_later = json_encode( $later_json );
        			$sql = "UPDATE `user` SET `cart`='".$json_cart."',`buy_later`='".$json_later."' WHERE id='".$user_data['id']."'";
        			$res = mysqli_query( $con, $sql );

					$_SESSION['toast_title'] = "Success!";
					$_SESSION['toast_msg'] = "Product added to Cart successfully.";
					$_SESSION['toast_type'] = "success";
					setcookie("show-toast", "yes", time()+1000,'/');

					header('location: ../cart.php');
        		}
    		}
		}
	}
?>
