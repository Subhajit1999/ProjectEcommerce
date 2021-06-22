<?php
	// Get the current url
 	$url = "http://";
    $url.= $_SERVER['HTTP_HOST'];
    $url.= $_SERVER['REQUEST_URI'];

	//Extracting the url params
	$url_components = parse_url($url);
	parse_str($url_components['query'], $params);
	$category_id = $params["id"];

	//Database work
	$con = mysqli_connect( "localhost", "root", "", "shopyard" );  // Connecting to the DB
	// Getting category data
	$prdct_sql = "select * from product where id='".$category_id."'";
	$prdct_res = mysqli_query( $con, $prdct_sql );
	$prdct_data = mysqli_fetch_array($prdct_res);

	$similar_sql = "select * from product where cat_id='".$prdct_data['cat_id']."' AND id!='".$prdct_data['id']."'";
	$similar_res = mysqli_query( $con, $similar_sql );

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $prdct_data['brand']." ".$prdct_data['short_desc'] ?> | ShopYard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap library css cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Font Awesome library for all the modern project icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Bootstrap js library cdn-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS StyleSheets -->
    <link rel="stylesheet" href="css/product-info.css">
</head>

<body>
    <!-------- Header (Toolbar & Navigation Bar)------------>
    <?php
        include 'common/header.php'; ?>

    <!------------ Product information -------------->
    <div class="hero">
        <div class="row product-info-row">
            <div class="col-4 images-section">

                <div class="slider">
                    <div class="product">
						<img src="<?php echo "data:image/jpeg;base64,".base64_encode( $prdct_data['feature_img'] ); ?>" alt="" onclick="clickme(<?php echo "data:image/jpeg;base64,".base64_encode( $prdct_data['feature_img'] ); ?>)">

						<img src="<?php echo "data:image/jpeg;base64,".base64_encode( $prdct_data['img1'] ); ?>" alt="" onclick="clickme(<?php echo 'data:image/jpeg;base64,'.base64_encode( $prdct_data['img1'] ); ?>)">

						<img src="<?php echo "data:image/jpeg;base64,".base64_encode( $prdct_data['img2'] ); ?>" alt="" onclick="clickme(<?php echo "data:image/jpeg;base64,".base64_encode( $prdct_data['img2'] ); ?>)">

						<img src="<?php echo "data:image/jpeg;base64,".base64_encode( $prdct_data['img3'] ); ?>" alt="" onclick="clickme(<?php echo "data:image/jpeg;base64,".base64_encode( $prdct_data['img3'] ); ?>)">

                    </div>
                    <div class="preview">

                        <img src="<?php echo "data:image/jpeg;base64,".base64_encode( $prdct_data['feature_img'] ); ?>" id="imagebox" alt="">
                    </div>
                </div>

            </div>

            <div class="col">
                <p class="brand">Brand: <?php echo $prdct_data['brand']; ?></p>
                <h1><?php echo $prdct_data['short_desc']; ?></h1>
				<?php
					$text = $prdct_data['long_desc'];
					$array = explode('.',$text);
				?>
                <p class="description"><?php echo $array[0]; ?></p>
				<!-- Review Section short -->
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                    <p>(256 reviews &#38; 986 ratings)</p>
                </div>
				<!-- Review Section short -->
				<?php
							if($prdct_data['mrp'] != $prdct_data['sale_price']) {
						?>
							<p class="price">Price: &#8377;<?php echo $prdct_data['sale_price']; ?> <del>&#8377;<?php echo $prdct_data['mrp']; ?></del><small> (<?php echo $prdct_data['discount']; ?>% off)</small></p>
						<?php
							}else {
						?>
							<p class="price">Price: &#8377;49.99</p>
						<?php
							}
						?>
                <p>Size: <select name="size">
s
                        <option value="select size">select size</option>
                        <option value="small">small</option>
                        <option value="medium">medium</option>
                        <option value="large">large</option>

                    </select></p>
                <p>Quantity: <input id="item-qty" type="text" value="1"></p>
                <div class="table btn-options">
                    <ul>
                        <li><a href="#">Buy Now</a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i>Add to Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="product-desc">
        <div class="container">
            <div class="title-box">
                <h2>Description</h2>
            </div>
            <p class="desc">
                <?php echo $prdct_data['long_desc']; ?>
            </p>
        </div>
    </section>

    <section class="product-desc">
        <div class="container">
            <div class="title-box">
                <h2>Reviews</h2>
            </div>
            <div class="row justify-content-end">
                <div class="col-2 rating-info">
                    <h2><b>4.2</b> <i class="fa fa-star"></i></h2>
                    <p>Based on 575 Ratings<br>&#38; 284 Reviews</p>
                </div>
                <div class="col-2 rating-counts">
                    <div class="main-rating">
                        <i class="fa fa-star" style="color: green;"></i>
                        <i class="fa fa-star" style="color: green;"></i>
                        <i class="fa fa-star" style="color: green;"></i>
                        <i class="fa fa-star" style="color: green;"></i>
                        <i class="fa fa-star" style="color: green;"></i>
                        <p>&nbsp;96</p>
                    </div>
                    <div class="main-rating">
                        <i class="fa fa-star" style="color: green;"></i>
                        <i class="fa fa-star" style="color: green;"></i>
                        <i class="fa fa-star" style="color: green;"></i>
                        <i class="fa fa-star" style="color: green;"></i>
                        <i class="fa fa-star-o" style="color: green;"></i>
                        <p>&nbsp;121</p>
                    </div>
                    <div class="main-rating">
                        <i class="fa fa-star" style="color: green;"></i>
                        <i class="fa fa-star" style="color: green;"></i>
                        <i class="fa fa-star" style="color: green;"></i>
                        <i class="fa fa-star-o" style="color: green;"></i>
                        <i class="fa fa-star-o" style="color: green;"></i>
                        <p>&nbsp;39</p>
                    </div>
                    <div class="main-rating">
                        <i class="fa fa-star" style="color: orange;"></i>
                        <i class="fa fa-star" style="color: orange;"></i>
                        <i class="fa fa-star-o" style="color: orange;"></i>
                        <i class="fa fa-star-o" style="color: orange;"></i>
                        <i class="fa fa-star-o" style="color: orange;"></i>
                        <p>&nbsp;6</p>
                    </div>
                    <div class="main-rating">
                        <i class="fa fa-star" style="color: red;"></i>
                        <i class="fa fa-star-o" style="color: red;"></i>
                        <i class="fa fa-star-o" style="color: red;"></i>
                        <i class="fa fa-star-o" style="color: red;"></i>
                        <i class="fa fa-star-o" style="color: red;"></i>
                        <p>&nbsp;22</p>
                    </div>
                </div>
            </div>
            <?php
                include 'common/review-snippet.html'; ?>
            <?php
                include 'common/review-snippet.html'; ?>
            <?php
                include 'common/review-snippet.html'; ?>
            <?php
                include 'common/review-snippet.html'; ?>
            <div class="table btn-options">
                <ul>
                    <li><a href="#">View more</a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="similar">
        <div class="container">
            <div class="title-box">
                <h2>Similar Items</h2>
            </div>
            <div class="row">
                <?php
					$i = 0;
					while(($similar_row = mysqli_fetch_array($similar_res)) and ($i<4)) {
				?>
                <div class="col-lg-3 col-sm-4 col-6">
                    <div class="product-top">
						<?php echo '<a href="/ecommerce/product-info.php?id='.$similar_row['id'].'"><img height=365 src="data:image/jpeg;base64,'.base64_encode( $similar_row['feature_img'] ).'"/></a>'; ?>
                    </div>
                    <div class="product-bottom text-center">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <h3><?php echo htmlspecialchars($similar_row['brand']); ?></h3>
                        <h4><i><?php echo htmlspecialchars($similar_row['short_desc']); ?></i></h4>
                        <?php
							if($similar_row['mrp'] != $similar_row['sale_price']) {
						?>
							<h5><b>&#8377; <?php echo $similar_row['sale_price']; ?></b> <del>&#8377; <?php echo $similar_row['mrp']; ?></del>  <b style="color:green; ">(<?php echo $similar_row['discount'];?>%)</b></h5>
						<?php
							}else {
						?>
							<h5><b>&#8377; <?php echo $similar_row['mrp']; ?></b></h5>
						<?php
							}
						?>
                    </div>
                </div>
				<?php
						$i++;
					}
				?>
            </div>
        </div>
    </section>

    <!----------- Footer -------------->
    <?php
        include 'common/footer.html'; ?>

    <!-------------------------- JS Scripts ---------------------------------->
    <script src="js/nav-drawer.js"></script>
    <script>
        function clickme(smallImg) {
			document.cookie = "small-img=" + smallImg;

            var fullImg = document.getElementById("imagebox");
			fullImg.setAttribute('src', "<?php echo $_COOKIE['small-img']; ?>");
//            fullImg.src = smallImg.src;

        }

    </script>
    <!------------------------------------------------------------------------>

</body>

</html>
