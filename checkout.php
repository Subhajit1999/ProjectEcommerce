<?php require_once 'php/handle_checkout.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout | ShopYard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- library validate -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    <!-- style css -->
    <link rel="stylesheet" href="css/checkout.css">
</head>

<body>
    <!-------- Header (Toolbar & Navigation Bar)------------>
    <?php
        include 'common/header.php'; ?>

    <!------- Chckout form ---------->
	<?php
	 $fullname = $user_data['fname']." ".$user_data['lname'];
	 $phone = $address = $city = $state = $pin = null;
	 $cardname = $cardnum = $expmnth = $expyr = null;
	 if(count($addr)>0) {
		 $fullname = $addr['name'];
		 $phone = $addr['phone'];
		 $address = $addr['addr'];
		 $city = $addr['city'];
		 $state = $addr['state'];
		 $pin = $addr['pin'];
	 }
	 if(count($card)>0) {
		 $cardname = $card['card_name'];
		 $cardnum = $card['number'];
		 $expmnth = $card['exp_month'];
		 $expyr = $card['exp_year'];
	 }
	?>
    <section class="checkout">
        <h2 class="heading">Complete Checkout</h2>
        <div class="row">
            <div class="col-75">
                <div class="container">
                    <form id="validate-checkout" action="" method="post">
                        <div class="row">
                            <div class="col-50">
                                <h3 class="section_heading">Billing Address</h3>
                                <label for="fname" class="field_title"><i class="fa fa-user"></i> Full Name</label>
                                <input type="text" id="fname" name="fullname" placeholder="Rohan Singh" value="<?php echo $fullname; ?>" required>

                                <label for="email" class="field_title2"><i class="fa fa-phone"></i> Phone</label>
                                <input type="text" id="phone" name="phone" placeholder="1234567890" value="<?php echo $phone; ?>" pattern="^\d{10}$" required>

								<div id="save-phone" style="margin-top: 10px;">
									<input type="checkbox" id="cb0" name="save-phone" style="width: 1.25rem;height: 1.25rem;border: 1px solid hsl(0, 0%, 85%);border-radius: 1px;vertical-align: sub;">
									<label for="cb0" style="font-size:14px; margin-left:6px; color:orangered;"><b>Save number to my profile</b></label>
								</div>

                                <label for="adr" class="field_title2"><i class="fa fa-address-card-o"></i> Address</label>
                                <input type="text" id="adr" name="address" placeholder="53 , Bmc Bldg,  Old Prabhadevi Road, Prabhadevi" value="<?php echo $address; ?>" required>

                                <label for="city" class="field_title2"><i class="fa fa-institution"></i> City</label>
                                <input type="text" id="city" name="city" placeholder=" Mumbai" value="<?php echo $city; ?>" required>

                                <div class="row">
                                    <div class="col-50">
                                        <label for="state" class="field_title2">State</label>
                                        <input type="text" id="state" name="state" placeholder=" Maharashtra" value="<?php echo $state; ?>" required>
                                    </div>
                                    <div class="col-50">
                                        <label for="zip" class="field_title2">Pin Code</label>
                                        <input type="text" id="pin" name="pin" placeholder="400025" value="<?php echo $pin; ?>" pattern="^\d{6}$" required>
                                    </div>
                                </div>
								<div id="save-addr" style="margin-top: 10px;">
									<input type="checkbox" id="cb1" name="save-addr" style="width: 1.25rem;height: 1.25rem;border: 1px solid hsl(0, 0%, 85%);border-radius: 1px;vertical-align: sub;">
    								<label for="cb1" style="font-size:14px; margin-left:6px; color:orangered;"><b>Save this address for future</b></label>
								</div>
                            </div>

                            <div class="col-50">
                                <h3 class="section_heading2">Payment</h3>
                                <label for="fname" class="field_title">Accepted Cards</label>
                                <div class="icon-container">
                                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                                </div>

                                <label style="margin-top:4rem;" for="cname" class="field_title">Name on Card</label>
                                <input type="text" id="cardname" name="cardname" placeholder="John Smith" value="<?php echo $cardname; ?>" required>

                                <label for="ccnum" class="field_title2">Credit/Debit card number</label>
                                <input type="text" id="cardnumber" name="cardnumber" placeholder="4532117249889982" value="<?php echo $cardnum; ?>" pattern="^\d{16}$" required>

                                <label for="expmonth" class="field_title2">Exp. Month</label>
                                <input type="text" id="expmonth" name="expmonth" placeholder="09 (For: september)" value="<?php echo $expmnth; ?>" pattern="^\d{2}$" required>
                                <div class="row">
                                    <div class="col-50">
                                        <label for="expyear" class="field_title2">Exp. Year</label>
                                        <input type="text" id="expyear" name="expyear" placeholder="2023" pattern="^\d{4}$" value="<?php echo $expyr; ?>" required>
                                    </div>
                                    <div class="col-50">
                                        <label for="cvv" class="field_title2">CVV/CVC</label>
                                        <input type="text" id="cvv" name="cvv" placeholder="352" pattern="^\d{3}$" required>
                                    </div>
                                </div>
								<div id="save-card" style="margin-top: 3rem;">
									<input type="checkbox" id="cb2" name="save-card" style="width: 1.25rem;height: 1.25rem;border: 1px solid hsl(0, 0%, 85%);border-radius: 1px;vertical-align: sub;">
									<label for="cb2" style="font-size:14px; margin-left:6px; color:orangered;"><b>Save this card for future</b></label>
								</div>
                            </div>
                        </div>
                        <input id="order-btn" type="submit" value="Place Your Order" class="submit" name=order>
                    </form>
                </div>
            </div>
            <div class="col-25">
                <div class="container">
                    <h3 class="summary_title">Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo count($cart_arr); ?></b></span></h3>
					<?php
						$total = 0; $title = "";
						foreach($cart_arr as $item) {
							$item_sql = "select * from product where id='".$item['id']."'";
							$item_res = mysqli_query( $con, $item_sql );
    						$product = mysqli_fetch_array( $item_res );

							$title = $product['brand']." - ".$product['short_desc'];
							if (strlen($title) > 30) {
							$title = substr($title, 0, 28) . '...';
							}
							$price = ((int) $product['sale_price']) * ((int) $item['qnty']);
							$total += $price;
					?>
                    <p><a href="product-info.php?id=<?php echo $item['id']; ?>" class="item_title"><?php echo $title; ?></a> <span class="price2">&#8377; <?php echo $price; ?></span></p>
					<?php
						}
					?>
                    <hr>
                    <p class="field_title" style="font-size: 1.6rem;font-weight:bold;">Total <span class="price">&#8377; <?php echo $total; ?></span></p>
					<h4 style="color:red;">&#9203; <b><?php echo $status; ?></b></h4>
                </div>
            </div>
        </div>
    </section>

    <!----------- Footer -------------->
    <?php
        include 'common/footer.html'; ?>

    <!-- JS Scripts -->
    <script src="js/nav-drawer.js"></script>
</body>

</html>
