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
	// Cart data
	$cart_json = json_decode( $user_data['cart'], true );
    $cart_arr = $cart_json != null? $cart_json['items']: array();
	// Addresses data
	$addr_json = json_decode( $user_data['addresses'], true );
    $addr_arr = $addr_json != null? $addr_json['addrs']: array();
	// Cards data
	$card_json = json_decode( $user_data['cards'], true );
    $card_arr = $card_json != null? $card_json['cards']: array();
	//Recent Orders data
	$recent_json = json_decode( $user_data['recent_orders'], true );
	$recent_arr = $recent_json != null? $recent_json['orders']: array();

	//Getting first saved address
	$addr = count($addr_arr)>0? $addr_arr[0] : array();

	//Getting first saved card
	$card = count($card_arr)>0? $card_arr[0] : array();

	$card_types = array("visa", "master", "amex", "dis");
	$rand_key = array_rand($card_types,1);
	$save_card_type = $card_types[$rand_key];
	$status = "Delivery expected on ".date("M d", strtotime("+7 days", time()));

	if(($_SERVER['REQUEST_METHOD']=='POST')and(isset($_POST['order']))){

		$fullname = $_REQUEST['fullname'];
		$phone = $_REQUEST['phone'];
		$address = $_REQUEST['address'];
		$city = $_REQUEST['city'];
		$state = $_REQUEST['state'];
		$pin = $_REQUEST['pin'];

		$cardname = $_REQUEST['cardname'];
		$cardnum = $_REQUEST['cardnumber'];
		$exp_month = $_REQUEST['expmonth'];
		$exp_year = $_REQUEST['expyear'];

		if(isset($_POST['save-addr'])) { // If save address is checked
			$exist = 0;
			foreach($addr_arr as $add) {
				if($add['addr']==$address and $add['pin']==$pin) {
					$exist = 1;
				}
			}
			if($exist==0) {
				$addr_item = array("name"=>$fullname, "addr"=>$address, "city"=>$city, "state"=>$state, "pin"=>$pin, "phone"=>$phone);
        		array_push($addr_arr, $addr_item);
				$addr_json['addrs'] = array_values($addr_arr);
        		$json = json_encode( $addr_json );
				$sql = "UPDATE `user` SET `addresses`='".$json."' WHERE id='".$user_data['id']."'";
				$res = mysqli_query( $con, $sql );
			}
		}

		if(isset($_POST['save-phone'])) { // If save address is checked
			$save_phone = "UPDATE `user` SET `mobile`='".$phone."' WHERE id='".$user_data['id']."'";
			$phone_res = mysqli_query( $con, $save_phone );
		}

		if(isset($_POST['save-card'])) { // If save card is checked
			$exist = 0;
			foreach($card_arr as $crd) {
				if($crd['number']==$cardnum) {
					$exist = 1;
				}
			}
			if($exist==0) {
				$card_item = array( "card_name"=>$cardname, "card_type"=>$save_card_type, "number"=>$cardnum, "exp_month"=>$exp_month, "exp_year"=>$exp_year);
        		array_push($card_arr, $card_item);
				$card_json['cards'] = array_values($card_arr);
        		$json = json_encode( $card_json );
				$sql = "UPDATE `user` SET `cards`='".$json."' WHERE id='".$user_data['id']."'";
				$res = mysqli_query( $con, $sql );
			}
		}
		// Place Order
		$ship_address = $address.", city: ".$city.", state: ".$state.", pin: ".$pin.", Phone: ".$phone;
		$total_amnt = 0;
		foreach($cart_arr as $item) {
			$item_sql = "select * from product where id='".$item['id']."'";
			$item_res = mysqli_query( $con, $item_sql );
    		$product = mysqli_fetch_array( $item_res );
			$price = ((int) $product['sale_price']) * ((int) $item['qnty']);
			$total_amnt += $price;
		}
		$reference = time();
		$payment_success = 1;
		$order_json['items'] = array_values($cart_arr);
		$json = json_encode($order_json);
		$user_id = $user_data['id'];
		$sql = "INSERT INTO `orders`(`items`, `cust_id`, `shipping_addr`, `total_amnt`, `order_no`, `status`, `payment_success`) VALUES ('$json','$user_id','$ship_address','$total_amnt','$reference','$status','$payment_success')";
		$res = mysqli_query( $con, $sql );

		if($res == TRUE) {  // If order successful
			array_push($recent_arr, $reference);
			$recent_json['orders'] = array_values($recent_arr);
			$json = json_encode($recent_json);
			$clear_cart = "UPDATE `user` SET `cart`='{\"items\":[]}',`recent_orders`='".$json."' WHERE id='".$user_data['id']."'";
			$clear_res = mysqli_query( $con, $clear_cart );

			if($clear_res == TRUE) {  // If clearing cart and update recent orders success
				$_SESSION['toast_title'] = "Success!";
				$_SESSION['toast_msg'] = "Order placed successfully.";
				$_SESSION['toast_type'] = "success";
				setcookie("show-toast", "yes", time()+1000,'/');
				header("location:checkout.php");
			}

		}else { // If order unsuccessful
			$_SESSION['toast_title'] = "Error!";
			$_SESSION['toast_msg'] = "Error placing your orders.";
			$_SESSION['toast_type'] = "error";
			setcookie("show-toast", "yes", time()+1000,'/');
			header("location:checkout.php");
		}
	}
?>
