<?php
	//Database work
	$con = mysqli_connect( "localhost", "root", "", "shopyard" );  // Connecting to the DB
	// Getting category data
	$sale_sql = "SELECT * from product ORDER BY discount DESC";
	$new_sql = "SELECT * from product ORDER BY total_purchase DESC";
	$sale_res = mysqli_query( $con, $sale_sql );
	$new_res = mysqli_query( $con, $new_sql );

	// Exclusive product
	$excl_sql = "SELECT * from product WHERE exclusive is True";
	$excl_res = mysqli_query( $con, $excl_sql );
	$excl_data = mysqli_fetch_array($excl_res);

//	echo "<script> alert(".mysqli_num_rows($new_res)."); </script>";
?>

<!DOCTYPE html>
<html>

<head>
    <!-- StyleSheets -->
    <link rel="stylesheet" href="css/products-main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!---------- Products Section ------------>

    <!-- Featured Categories -->
    <section class="featured-categories">
        <div class="container">
            <div class="title-box">
                <h2>Popular</h2>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-4">
					<a href="/ecommerce/category-products.php?cat_id=402"><img src="img/men-bottomwear.png"></a>
                </div>
                <div class="col-md-4 col-sm-4 col-4">
                    <a href="/ecommerce/category-products.php?cat_id=409"><img src="img/women-shoe.png"></a>
                </div>
                <div class="col-md-4 col-sm-4 col-4">
                    <a href="/ecommerce/category-products.php?cat_id=414"><img src="img/girl-clothing.png"></a>
                </div>
            </div>
        </div>
    </section>

    <!-- On sale product -->
    <section class="on-sale">
        <div class="container">
            <div class="title-box">
                <h2>On Sale</h2>
            </div>
            <div class="row">
				<?php
					$i = 0;
					while($sale_row = mysqli_fetch_array($sale_res) and $i < 4) {
				?>
                <div class="col-lg-3 col-sm-4 col-6">
                    <div class="product-top">
						<?php echo '<a href="/ecommerce/product-info.php?id='.$sale_row['id'].'"><img height=365 src="data:image/jpeg;base64,'.base64_encode( $sale_row['feature_img'] ).'"/></a>'; ?>
                    </div>
                    <div class="product-bottom text-center">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <h3><?php echo htmlspecialchars($sale_row['brand']); ?></h3>
                        <h4><i><?php echo htmlspecialchars($sale_row['short_desc']); ?></i></h4>
                        <h5><b>&#8377; <?php echo $sale_row['sale_price']; ?></b> <del>&#8377; <?php echo $sale_row['mrp']; ?></del>  <b style="color:green; ">(<?php echo $sale_row['discount'];?>%)</b></h5>
                    </div>
                </div>
				<?php
						$i++;
					}
				?>
            </div>
        </div>
    </section>

    <!-- Exclusive offer section -->
    <section class="exclusive">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="img/exclusive.png" class="offer-img">
                </div>
                <div class="col-2">
                    <p><b>Exclusively</b> available on ShopYard</p>
                    <h1> <span style="color:orangered;"><?php echo $excl_data['brand']." " ?></span><?php echo $excl_data['short_desc']; ?></h1>
					<?php
						$text = $excl_data['long_desc'];
						$array = explode('.',$text);
						$saving = $excl_data['mrp']-$excl_data['sale_price'];
					?>
                    <small> <?php echo $array[0]."."; ?> </small>
                    <h3>Now only @ <del>&#8377;<?php echo $excl_data['mrp']; ?></del> &#8377;<?php echo $excl_data['sale_price']; ?> (You will save: &#8377;<?php echo $saving; ?>)</h3>
                    <div>
                        <button>
							<a href="/ecommerce/product-info.php?id=<?php echo $excl_data['id']; ?>" style="text-decoration:none; color:white;"><h5>Buy Now</h5></a>
                    	</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Products -->
    <section class="new-products">
        <div class="container">
            <div class="title-box">
                <h2>New Arrivals</h2>
            </div>

            <div class="row">
                <?php
					$j = 0;
					while($new_row = mysqli_fetch_array($new_res) and ($j<8)) {
				?>
                <div class="col-lg-3 col-sm-4 col-6">
                    <div class="product-top">
						<?php echo '<a href="/ecommerce/product-info.php?id='.$new_row['id'].'"><img height=365 src="data:image/jpeg;base64,'.base64_encode( $new_row['feature_img'] ).'"/></a>'; ?>
                    </div>
                    <div class="product-bottom text-center">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <h3><?php echo htmlspecialchars($new_row['brand']); ?></h3>
                        <h4><i><?php echo htmlspecialchars($new_row['short_desc']); ?></i></h4>
                        <?php
							if($new_row['mrp'] != $new_row['sale_price']) {
						?>
							<h5><b>&#8377; <?php echo $new_row['sale_price']; ?></b> <del>&#8377; <?php echo $new_row['mrp']; ?></del>  <b style="color:green; ">(<?php echo $new_row['discount'];?>%)</b></h5>
						<?php
							}else {
						?>
							<h5><b>&#8377; <?php echo $new_row['mrp']; ?></b></h5>
						<?php
							}
						?>
                    </div>
                </div>
				<?php
						$j++;
					}
				?>
            </div>
        </div>
    </section>
</body>

</html>
