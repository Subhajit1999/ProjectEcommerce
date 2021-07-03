<?php require_once "php/profile_config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My Account | ShopYard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap library css cdn-->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Font Awesome library for all the modern project icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Bootstrap js library cdn-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <link href="css/profile.css" rel="stylesheet">
</head>

<body>


    <div class="main-body">
        <!-------- Header (Toolbar & Navigation Bar)------------>
        <?php
        include 'common/header.php'; ?>

        <div class="container body-container">

            <div class="row main-row">
                <!------ Profile Card with nav elements ---------->
                <div class="profile-nav col-lg-3 col-12">
                    <div class="panel">
                        <div class="user-heading round">
                            <a href="#">
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                            </a>
                            <h1 class="user-name"><?php echo $user_data['fname']." ".$user_data['lname']; ?></h1>
                            <p><?php echo $user_data['email']; ?></p>
                        </div>

                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="#"> <i class="fa fa-user"></i> <b>Profile</b></a></li>
							<li><a href="session_log_out.php"> <i class="fa fa-sign-out"></i><b>Log Out</b></a></li>
                        </ul>
                    </div>
                </div>

                <!------ Account informations ---------->
                <div class="profile-info col-lg-9 col-12">
                    <div class="panel">

                        <!------ Personal Info ---------->
                        <div class="panel-body bio-graph-info">
                            <h1>Personal Details</h1>
                            <div class="row">
                                <div class="col-sm-6 bio-row">
                                    <p><span>First Name </span>: <?php echo $user_data['fname']; ?></p>
                                </div>
                                <div class="col-sm-6 bio-row">
                                    <p><span>Last Name </span>: <?php echo $user_data['lname']; ?></p>
                                </div>
                                <div class="col-sm-6 bio-row">
                                    <p><span>Email </span>: <?php echo $user_data['email']; ?></p>
                                </div>
                                <div class="col-sm-6 bio-row">
                                    <p><span>Mobile </span>: <?php
										$phone = $user_data['mobile']!=null?$user_data['mobile'] : 'Not set yet';
										echo $phone;
										?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!------ Row 1 Panel Card 1 (Recent Orders) ---------->
                        <div class="col-md-6 col-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <h3>Recent Orders</h3>
                                    <!------ Orders card ------>
									<?php
										$i = 0;
										while($recent_row = mysqli_fetch_array($recent_res) and $i<2) {
											$item_json = json_decode( $recent_row['items'], true );
											$item_arr = $item_json != null? $item_json['items']: array();

											foreach($item_arr as $item) {
												if($i<2) {
													$sql = "select * from product where id='".$item['id']."'";
													$res = mysqli_query($con, $sql);
    												$data = mysqli_fetch_array($res);
									?>
                                    <div class="row orders-row">
                                        <div class="col-4">
											<?php echo '<img height=365 src="data:image/jpeg;base64,'.base64_encode( $data['feature_img'] ).'" class="recent-orders-img"/>'; ?>
                                        </div>
                                        <div class="col-8 orders-info">
                                            <h5 class="recent-orders-h5"><?php echo $recent_row['status']; ?></h5>
                                            <p class="recent-orders-p"><?php echo $data['brand']." - ".$data['short_desc']; ?></p>
                                        </div>
                                    </div>
									<?php
												}
											$i++;
											}
										}
									?>
                                </div>
                            </div>
                        </div>
                        <!------ Row 1 Panel Card 2 (Saved Addresses) ---------->
                        <div class="col-md-6 col-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <h3 class="address-title">Saved Addresses</h3>
                                    <div class="row address-row">
										<?php
											foreach($addr_arr as $addr) {
												$address = $addr['addr'].", ".$addr['city'].", ".$addr['state']." - ".$addr['pin']." | Phone: ".$addr['phone'];
										?>
                                        <div class="col-12 address-col">
                                            <h5 class="recent-orders-h5"><?php echo $addr['name']; ?></h5>
                                            <div class="row">
                                                <div class="col-10">
                                                    <p class="recent-orders-p"><?php echo $address; ?></p>
                                                </div>
                                                <div class="col-1 address-edit">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
										<?php
											}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!------ Row 2 Panel Card 1 (Wishlist) ---------->
                        <div class="col-md-6 col-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <h3>My Wishlist</h3>
                                    <!------ Wishlist product card ------>
                                    <div class="row orders-row">
                                        <div class="col-4">
                                            <img src="https://rukminim1.flixcart.com/image/580/696/kl9rssw0/shoe/u/h/0/7-hkk72-adidas-conavy-scrora-stone-original-imagyfkkzvykmgwz.jpeg" class="recent-orders-img">
                                        </div>
                                        <div class="col-6">
                                            <h5 class="recent-orders-h5">ADIDAS <span class="wishlist-price">&#8377; 55.45</span></h5>
                                            <p class="recent-orders-p">Adi-Dash M Running Shoes For Men</p>
                                        </div>
                                    </div>
                                    <!------ Wishlist product card ------>
                                    <div class="row orders-row">
                                        <div class="col-4">
                                            <img src="https://rukminim1.flixcart.com/image/580/696/kdnf98w0hlty2aw-0/t-shirt/i/i/5/-original-imafunx3fzsrxjwh.jpeg?q=50" class="recent-orders-img">
                                        </div>
                                        <div class="col-6">
                                            <h5 class="recent-orders-h5">TRIPR <span class="wishlist-price">&#8377; 21.99</span></h5>
                                            <p class="recent-orders-p">Abstract Men Hooded Neck Dark Blue T-Shirt</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------ Row 2 Panel Card 2 (Saved Cards) ---------->
                        <div class="col-md-6 col-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <h3>Saved Cards</h3>
                                    <!------ Orders card ------>
									<?php
										foreach($card_arr as $card) {
											$card_num = '**** **** **** ';
											$card_num .= substr($card['number'], 12, 4);
											$imgPath = $cardName = '';
											switch($card['card_type']) {
												case 'visa':
													$imgPath = "img/visa.png";
													$cardName = 'Visa Platinum';
													break;
												case 'master':
													$imgPath = "img/mastercard.png";
													$cardName = 'MasterCard';
													break;
												case 'amex':
													$imgPath = "img/amex.png";
													$cardName = 'American Express';
													break;
												case 'dis':
													$imgPath = "img/discover.png";
													$cardName = 'Discover';
													break;
											}
									?>
                                    <div class="row orders-row">
                                        <div class="col-4">
                                            <img src="<?php echo $imgPath; ?>" class="recent-orders-img" style="padding: 8px;">
                                        </div>
                                        <div class="col-7">
                                            <h5 class="recent-orders-h5"><?php echo $card_num; ?></h5>
                                            <p class="recent-orders-p"><b><?php echo $cardName; ?></b></p>
                                        </div>
                                        <div class="col-1 card-delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </div>
                                    </div>
									<?php
										}
									?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!----------- Footer -------------->
        <?php
        include 'common/footer.html'; ?>
    </div>

    <!------ JS Scripts ---------->
    <script src="js/nav-drawer.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>
