<?php
if ( session_status() != PHP_SESSION_ACTIVE ) {
    session_start();
}

// Get the current url
$url = "http://";
$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];

//Extracting the url params
$url_components = parse_url( $url );
parse_str( $url_components['query'], $params );
$src = $params["src"];

$item_id = (int) $params["id"];
$qnty = (int) $params["qty"];
$size = $params["size"];

if ( !isset( $_SESSION['user'] ) ) {
    // Login
    header( "location:/ecommerce/auth.php?src=product&id=".$item_id."&qty=".$qnty."&size=".$size);

} else { // Add product to cart
    //Database work
    $con = mysqli_connect( "localhost", "root", "", "shopyard" ); // Connecting to the DB
    // Getting user
    $user_sql = "select * from user where email='".$_SESSION['user']."'";
    $user_res = mysqli_query( $con, $user_sql );
    $user_data = mysqli_fetch_array( $user_res );

    $cart_json = json_decode( $user_data['cart'], true );
    $cart_arr = $cart_json != null? $cart_json['items']: array();

    $exist = 'false';
    foreach ( $cart_arr as $item ) {
        if ( $item['id'] == $item_id ) {
            $exist = 'true';
            break;
        }
    }

    if ( $exist == 'true' ) { // If item already added
		$_SESSION['toast_title'] = "Warning!";
		$_SESSION['toast_msg'] = "Product already added to cart.";
		$_SESSION['toast_type'] = "warning";
		setcookie("show-toast", "yes", time()+1000,'/');

        if ( $src == 'buy' ) {
            header( "location: ../cart.php" );
        } else {
            header( "location: ../product-info.php?id=".$item_id );
        }
    } else {  // If item not added, add
        // Call add to cart function
        $item_arr = array( "id"=>$item_id, "qnty"=>$qnty, "size"=>$size );
        array_push( $cart_arr, $item_arr );
        $cart_json['items'] = $cart_arr;
        $json = json_encode( $cart_json );

        $cart_sql = "UPDATE `user` SET `cart`='".$json."' WHERE id='".$user_data['id']."'";
        $cart_res = mysqli_query( $con, $cart_sql );

        if ( $cart_res == TRUE ) {  // update successful
			$_SESSION['toast_title'] = "Success!";
			$_SESSION['toast_msg'] = "Product added to Cart successfully.";
			$_SESSION['toast_type'] = "success";
			setcookie("show-toast", "yes", time()+1000,'/');

            if ( $src == 'buy' ) {
                header( "location: ../cart.php" );
            } else {
				header( "location: ../product-info.php?id=".$item_id );
            }
        } else {  // error occcured
			$_SESSION['toast_title'] = "Error!";
			$_SESSION['toast_msg'] = "There's an error adding product to Cart.";
			$_SESSION['toast_type'] = "error";
			setcookie("show-toast", "yes", time()+1000,'/');

            header( "location: ../product-info.php?id=".$item_id );
        }

    }
}
?>
