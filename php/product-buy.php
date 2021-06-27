<?php
session_start();

// Get the current url
$url = "http://";
$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];

//Extracting the url params
$url_components = parse_url( $url );
parse_str( $url_components['query'], $params );
$src = $params["src"];

$item_id = '';
$qty = '';
$size = '';
if ( $src != 'auth' ) {
    $item_id = (int) $params["id"];
    $qty = (int) $params["qty"];
    $size = (int) $params["size"];
}

if ( !isset( $_SESSION['user'] ) ) {
    // Login
    header( "location:/ecommerce/auth.php?src=product" );

} else {
    // Add product to cart
    //Database work
    $con = mysqli_connect( "localhost", "root", "", "shopyard" );
    // Connecting to the DB
    // Getting user
    $user_sql = "select * from user where email='".$_SESSION['user']."'";
    $user_res = mysqli_query( $con, $user_sql );
    $user_data = mysqli_fetch_array( $user_res );

    $cart_json = json_decode( $user_data['cart'], true );
    $cart_arr = $cart_json != null? $cart_json['items']: array();

	$exist = 'false';
	foreach($cart_arr as $item) {
		if($item['id']==$item_id) {
			$exist = 'true';
			break;
		}
	}

    if ($exist=='true') {   // If item already added
		if($src=='buy') {
			header("location: ../cart.php");
		}else{
			header("location: ../product-info.php?id=".$item_id);
		}
    } else {   								   // If item not added, add
        // Call add to cart function
		$item_arr = array( "id"=>$item_id, "qnty"=>$qty, "size"=>$size );
    	array_push( $cart_arr, $item_arr );
		$cart_json['items'] = $cart_arr;
    	$json = json_encode($cart_json);

		$cart_sql = "UPDATE `user` SET `cart`='".$json."' WHERE id='".$user_data['id']."'";
		$cart_res = mysqli_query( $con, $cart_sql );

		if($cart_res == TRUE) {
			// update successful
			if($src=='buy') {
				header("location: ../cart.php");
			}else {

			}
			echo "<script> alert('Hello ".$json."'); </script>";
		}else {
			// error occcured
			header("location: ../product-info.php?id=".$item_id);
		}

    }
}
?>
