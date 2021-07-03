<?php require_once 'php/handle_cart.php'; ?>

<!DOCTYPE html>
<html>

<head>

    <title>Shopping Cart | ShopYard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap library css cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Font Awesome library for all the modern project icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Bootstrap js library cdn-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/cart.css">

</head>

<body>
    <!-------- Header (Toolbar & Navigation Bar)------------>
    <?php
        include 'common/header.php'; ?>

    <!--------- Cart Items ----------->
	<?php
		if(count($cart_arr)==0 and count($later_arr)==0) {
	?>
	<div class="nothing-msg-container">
			<h1 style="text-align:center;font-size:40px;font-weight:bold;color:orangered;margin-top:10%;">Empty!<span style='font-size:40px;'>&#128532;</span></h1>

			<h2 style="text-align:center;margin-bottom:15%;color:#3a3a3a;font-family: 'Satisfy', cursive;font-size:26px;">There's nothing in your Shopping Cart. Try to add some.</h2>
	</div>
	<?php
		} else {
	?>
	<div class="container">
		<!---------- Shopping Cart ------------>
        <div class="title-box">
            <h2>Shopping Cart</h2>
        </div>
		<?php
			if(count($cart_arr)>0) {
		?>
        <div class="cart">
			<!-- Shopping cart items -->
            <div class="products col-md-9">
				<?php
					foreach($cart_arr as $item) {
						$item_sql = "select * from product where id='".$item['id']."'";
						$item_res = mysqli_query( $con, $item_sql );
    					$item_data = mysqli_fetch_array( $item_res );

						//Price calculations
						$bill_price += $item_data['sale_price'];
						$saving += $item_data['mrp'] - $item_data['sale_price'];
				?>
				<div class="product">
					<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $item_data['feature_img'] ).'"/>'; ?>

                    <div class="col-lg-6 col-md-5 product-info">
                        <h2 class="product-name"><?php
						$str = $item_data['brand']." - ".$item_data['short_desc'];
						if (strlen($str) > 50) {
							$str = substr($str, 0, 47) . '...';
						}
						echo $str; ?></h2>

					<?php
						if($item_data['mrp'] != $item_data['sale_price'] and $item_data['discount']>0) {
					?>
						<h4 class="product-price">&#8377; <?php echo $item_data['sale_price']; ?> <del>&#8377; <?php echo $item_data['mrp']; ?></del></h4>
                        <h4 class="product-offer"><?php echo $item_data['discount']; ?>% discount applied</h4>
					<?php
						}else {
					?>
						<h4 class="product-price">&#8377; <?php echo $item_data['mrp']; ?></h4>
					<?php
						}
					?>
                        <p class="product-quantity">Quantity: <input value="<?php echo $item['qnty']; ?>" name="" disabled>
                    </div>
                    <div class="col-md-2 buttons">
                        <a href="php/handle_cart.php?id=<?php echo $item['id']; ?>&action=buy-later" style="text-decoration:none;"><p class="product-remove">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <span class="remove">Buy later</span>
                        </p></a>
                        <a href="php/handle_cart.php?id=<?php echo $item['id']; ?>&action=remove&section=cart" style="text-decoration:none;"><p class="product-remove">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            <span class="remove" >Remove</span>
						</p></a>
                    </div>
                </div>
				<?php
					}
				?>
            </div>
		<!-- Price details container -->
            <div class="cart-total col-md-3">
                <p>
                    <span class="cart-summary-title">Total Price</span>
                    <span class="cart-summary-price">&#8377; <?php echo $bill_price; ?></span>
                </p>
                <p>
                    <span class="cart-summary-title">Number of Items</span>
                    <span class="cart-summary-price"><?php echo count($cart_arr); ?></span>
                </p>
                <p>
                    <span class="cart-summary-title">You will Save</span>
                    <span class="cart-summary-price">&#8377; <?php echo $saving; ?></span>
                </p>
                <a href="checkout.php">Proceed to Checkout</a>
            </div>
        </div>
		<?php
			}else {
		?>
		<div class="nothing-msg-container">
			<h1 style="text-align:center;font-size:30px;font-weight:bold;color:orangered;margin-top:10%;">Empty!<span style='font-size:30px;'>&#128532;</span></h1>

			<h2 style="text-align:center;margin-bottom:15%;color:#3a3a3a;font-family: 'Satisfy', cursive;font-size:22px;">There's nothing in the cart. Try to add some.</h2>
		</div>
		<?php
			}
		?>

		<!------------- Buy Later ------------->
		<div class="title-box">
            <h2>Buy Later</h2>
        </div>
		<?php
			if(count($later_arr)>0) {
		?>
        <div class="cart">
			<!-- Shopping cart items -->
            <div class="products col-md-9">
				<?php
					foreach($later_arr as $item) {
						$item_sql = "select * from product where id='".$item['id']."'";
						$item_res = mysqli_query( $con, $item_sql );
    					$item_data = mysqli_fetch_array( $item_res );
				?>
				<div class="product">
					<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $item_data['feature_img'] ).'"/>'; ?>

                    <div class="col-lg-6 col-md-5 product-info">
                        <h2 class="product-name"><?php
						$str = $item_data['brand']." - ".$item_data['short_desc'];
						if (strlen($str) > 50) {
							$str = substr($str, 0, 47) . '...';
						}
						echo $str; ?></h2>

					<?php
						if($item_data['mrp'] != $item_data['sale_price'] and $item_data['discount']>0) {
					?>
						<h4 class="product-price">&#8377; <?php echo $item_data['sale_price']; ?> <del>&#8377; <?php echo $item_data['mrp']; ?></del></h4>
                        <h4 class="product-offer"><?php echo $item_data['discount']; ?>% discount applied</h4>
					<?php
						}else {
					?>
						<h4 class="product-price">&#8377; <?php echo $item_data['mrp']; ?></h4>
					<?php
						}
					?>
                        <p class="product-quantity">Quantity: <input value="<?php echo $item['qnty']; ?>" name="" disabled>
                    </div>
                    <div class="col-md-2 buttons">
                        <a href="php/handle_cart.php?id=<?php echo $item['id']; ?>&action=move-to-cart" style="text-decoration:none;"><p class="product-remove">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            <span class="remove" >Add to Cart</span>
						</p></a>
						<a href="php/handle_cart.php?id=<?php echo $item['id']; ?>&action=remove&section=buy-later" style="text-decoration:none;"><p class="product-remove">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            <span class="remove" >Remove</span>
						</p></a>
                    </div>
                </div>
				<?php
					}
				?>
            </div>
        </div>
		<?php
			}else {
		?>
		<div class="nothing-msg-container">
			<h1 style="text-align:center;font-size:30px;font-weight:bold;color:orangered;margin-top:10%;">Empty!<span style='font-size:30px;'>&#128512;</span></h1>

			<h2 style="text-align:center;margin-bottom:15%;color:#3a3a3a;font-family: 'Satisfy', cursive;font-size:22px;">There's nothing saved to Buy Later.</h2>
		</div>
		<?php
			}
		?>
    </div>
	<?php
		}
	?>

    <!----------- Footer -------------->
    <?php
        include 'common/footer.html'; ?>

    <!-------------------------- JS Scripts ---------------------------------->
    <script src="js/nav-drawer.js"></script>
    <!------------------------------------------------------------------------>
</body>

</html>
