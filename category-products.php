<?php
	// Get the current url
 	$url = "http://";
    $url.= $_SERVER['HTTP_HOST'];
    $url.= $_SERVER['REQUEST_URI'];

	//Extracting the url params
	$url_components = parse_url($url);
	parse_str($url_components['query'], $params);
	$category_id = $params["cat_id"];

	//Database work
	$con = mysqli_connect( "localhost", "root", "", "shopyard" );  // Connecting to the DB
	// Getting category data
	$cat_sql = "select * from category where id='".$category_id."'";
	$cat_res = mysqli_query( $con, $cat_sql );
	$cat_data = mysqli_fetch_array($cat_res);
	//Getting products data
	$trend_sql = "select * from product where cat_id='".$category_id."' AND trending LIKE 'yes' LIMIT 4";
	$more_sql = "select * from product where cat_id='".$category_id."' AND trending LIKE 'no'";
    $trend_res = mysqli_query( $con, $trend_sql );
	$more_res = mysqli_query( $con, $more_sql );

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $cat_data['cat_name']; ?> | ShopYard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap library css cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Font Awesome library for all the modern project icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Bootstrap js library cdn-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS StyleSheets -->
    <link rel="stylesheet" href="css/category-products.css">
</head>

<body>
    <!-------- Header (Toolbar & Navigation Bar)------------>
    <?php
        include 'common/header.php'; ?>

    <!-- Banner Carousel -->
    <div class="banner">
        <div class="cateegory-image">
			<?php echo '<img src="data:image/png;base64,'.base64_encode($cat_data["cat_img_banner"]).'" alt="" width="100%"/>'; ?>
        </div>
    </div>

    <!--------- Category based products ------------>
        <!-- On sale product -->
	<?php
		if(mysqli_num_rows($trend_res)!=0 or mysqli_num_rows($more_res)!=0) {
	?>
    <section class="category-products">
        <div class="container">
            <div class="title-box">
                <h2>Trending Now</h2>
            </div>
		<?php
			if(mysqli_num_rows($trend_res)!=0) {
		?>
            <div class="row">
				<?php
					while($trend_row = mysqli_fetch_array($trend_res)) {
				?>
                <div class="col-lg-3 col-sm-4 col-6">
                    <div class="product-top">
						<?php echo '<a href="/ecommerce/product-info.php?id='.$trend_row['id'].'"><img height=365 src="data:image/jpeg;base64,'.base64_encode( $trend_row['feature_img'] ).'"/></a>'; ?>
                    </div>
                    <div class="product-bottom text-center">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <h3><?php echo htmlspecialchars($trend_row['brand']); ?></h3>
                        <h4><i><?php echo htmlspecialchars($trend_row['short_desc']); ?></i></h4>
                        <?php
							if($trend_row['mrp'] != $trend_row['sale_price']) {
						?>
							<h5><b>&#8377; <?php echo $trend_row['sale_price']; ?></b> <del>&#8377; <?php echo $trend_row['mrp']; ?></del>  <b style="color:green; ">(<?php echo $trend_row['discount'];?>%)</b></h5>
						<?php
							}else {
						?>
							<h5><b>&#8377; <?php echo $trend_row['mrp']; ?></b></h5>
						<?php
							}
						?>
                    </div>
                </div>
				<?php
					}
				?>
            </div>
			<?php
				}else{
			?>
				<div class="container">
                  <div class="nothing-msg-container">
					<h1 style="text-align:center;font-size:30px;font-weight:bold;color:orangered;margin-top:10%;">Empty!<span style='font-size:30px;'>&#128532;</span></h1>

					<h2 style="text-align:center;margin-bottom:15%;color:#3a3a3a;font-family: 'Satisfy', cursive;font-size:22px;">There's no product in Trending right now.</h2>
				   </div>
        		</div>
			<?php
				}
			?>
        </div>
    </section>

    <section class="category-products">
        <div class="container">
            <div class="title-box">
                <h2>More Products</h2>
            </div>
			<?php
				if(mysqli_num_rows($more_res)!=0) {
			?>
            <div class="row">
				<?php
					while($more_row = mysqli_fetch_array($more_res)) {
				?>
                <div class="col-lg-3 col-sm-4 col-6">
                    <div class="product-top">
						<?php echo '<a href="/ecommerce/product-info.php?id='.$more_row['id'].'"><img height=365 src="data:image/jpeg;base64,'.base64_encode( $more_row['feature_img'] ).'"/></a>'; ?>
                    </div>
                    <div class="product-bottom text-center">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <h3><?php echo htmlspecialchars($more_row['brand']); ?></h3>
                        <h4><i><?php echo htmlspecialchars($more_row['short_desc']); ?></i></h4>
                        <?php
							if($more_row['mrp'] != $more_row['sale_price']) {
						?>
							<h5><b>&#8377; <?php echo $more_row['sale_price']; ?></b> <del>&#8377; <?php echo $more_row['mrp']; ?></del></h5>
						<?php
							}else {
						?>
							<h5><b>&#8377; <?php echo $more_row['mrp']; ?></b></h5>
						<?php
							}
						?>
                    </div>
                </div>
				<?php
					}
				?>
            </div>
			<?php
			}else{
	?>
				<div class="container">
                  <div class="nothing-msg-container">
					<h1 style="text-align:center;font-size:30px;font-weight:bold;color:orangered;margin-top:10%;">Empty!<span style='font-size:30px;'>&#128532;</span></h1>

					<h2 style="text-align:center;margin-bottom:15%;color:#3a3a3a;font-family: 'Satisfy', cursive;font-size:22px;">There's no other product available in this category.</h2>
				   </div>
        		</div>
	<?php
			}
	?>
        </div>
    </section>
	<?php
		}else{
	?>
			<section class="category-products">
        		<div class="container">
                  <div class="nothing-msg-container">
					<h1 style="text-align:center;font-size:30px;font-weight:bold;color:orangered;margin-top:10%;">Sorry!<span style='font-size:30px;'>&#128532;</span></h1>

					<h2 style="text-align:center;margin-bottom:15%;color:#3a3a3a;font-family: 'Satisfy', cursive;font-size:22px;">There's no product in this category. We will add soon.</h2>
				   </div>
        		</div>
    </section>
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
