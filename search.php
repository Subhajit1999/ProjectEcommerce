<?php
	$url = "http://";
    $url.= $_SERVER['HTTP_HOST'];
    $url.= $_SERVER['REQUEST_URI'];

	//Extracting the url params, if any
	$url_components = parse_url($url);
	parse_str($url_components['query'], $params);
	$search_term = $params['term'];

	// Database work
	$con = mysqli_connect( "localhost", "root", "", "shopyard" );  //DB Connection
	$sql = "SELECT * FROM product WHERE brand LIKE '%".$search_term."%' OR short_desc LIKE '%".$search_term."%' OR long_desc LIKE '%".$search_term."%'";
	$result = mysqli_query($con, $sql);
	$count = $result != FALSE? mysqli_num_rows($result) : 0;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Search Products | ShopYard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap library css cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Font Awesome library for all the modern project icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Bootstrap js library cdn-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS StyleSheets -->
    <link rel="stylesheet" href="css/search.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
</head>

<body>
    <!-------- Header (Toolbar & Navigation Bar)------------>
    <?php
        include 'common/header.php'; ?>

    <!-- Main Body -->
    <section class="search-body">

        <!------- Products -------->
        <div class="container">
            <h2 class="search-heading">Showing search Result for: <span><?php echo $search_term; ?></span></h2>
			<?php
					// If no data found
					if($count==0) {
				?>
						<div class="nothing-msg-container">
							<h1 style="text-align:center;font-size:40px;font-weight:bold;color:orangered;margin-top:10%;">Sorry!<span style='font-size:40px;'>&#128532;</span></h1>

							<h2 style="text-align:center;margin-bottom:10%;color:#3a3a3a;font-family: 'Satisfy', cursive;font-size:26px;">Not found what you are looking for.</h2>
						</div>
				<?php
					}
			?>
            <div class="row">
				<?php
					while($search_row = mysqli_fetch_array($result)) {
				?>
                <div class="col-lg-3 col-sm-4 col-6">
                    <div class="product-top">
						<?php echo '<a href="/ecommerce/product-info.php?id='.$search_row['id'].'"><img height=365 src="data:image/jpeg;base64,'.base64_encode( $search_row['feature_img'] ).'"/></a>'; ?>
                    </div>
                    <div class="product-bottom text-center">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <h3><?php echo htmlspecialchars($search_row['brand']); ?></h3>
                        <h4><i><?php echo htmlspecialchars($search_row['short_desc']); ?></i></h4>
                        <?php
							if($search_row['mrp'] != $search_row['sale_price']) {
						?>
							<h5><b>&#8377; <?php echo $search_row['sale_price']; ?></b> <del>&#8377; <?php echo $search_row['mrp']; ?></del>  <b style="color:green; ">(<?php echo $search_row['discount'];?>%)</b></h5>
						<?php
							}else {
						?>
							<h5><b>&#8377; <?php echo $search_row['mrp']; ?></b></h5>
						<?php
							}
						?>
                    </div>
                </div>
				<?php
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
    <!------------------------------------------------------------------------>
</body>

</html>
