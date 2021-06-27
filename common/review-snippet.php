<?php
	$review_id = 0;
	if(isset($_SESSION['review_id'])) {
		$review_id = $_SESSION['review_id'];
		unset($_SESSION['review_id']);
	}

	$rating = ""; $title = ""; $desc = ""; $author = ""; $location = ""; $date = "";
	switch($review_id) {
		case 0:
			$rating = '4.0';
			$title = 'Quality is pretty good!';
			$desc = 'This is a nice quality product. Also look & feel is so good. I really liked it.';
			$author = 'Subhajit Kar';
			$location = 'Uluberia';
			$date = '20 June, 2021';
			break;
		case 1:
			$rating = '2.7';
			$title = 'Not very good';
			$desc = "the quality of this product not upto the mark. Don't buy it.";
			$author = 'Nitin Paul';
			$location = 'Kolkata';
			$date = '10 March, 2021';
			break;
		case 2:
			$rating = '4.5';
			$title = 'Awesome!';
			$desc = 'Great quality, amazing product. Very satisfied. Thank you ShopYard.';
			$author = 'Priti Moitra';
			$location = 'Malda';
			$date = '11 February, 2021';
			break;
		case 3:
			$rating = '4.8';
			$title = 'Amazing Product';
			$desc = 'Quality of this product is really great and also the materials used are of good quality. You should buy it';
			$author = 'Rajesh Bera';
			$location = 'Palashchabri';
			$date = '21 March, 2021';
			break;
	}
//	echo "<script> alert(".$review_id."); </script>";
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="footer, address, phone, icons" />

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <!-- StyleSheets -->
    <link rel="stylesheet" href="css/footer.css">

</head>

<body>
    <div class="user-review">
        <p><span><?php echo $rating; ?> <i class="fa fa-star"></i></span> <?php echo $title; ?></p>
        <p class="review-desc"><?php echo $desc; ?></p>
        <p class="review-author"><?php echo $author; ?> &#8226; <?php echo $location; ?> &#8226; <?php echo $date; ?></p>
    </div>
</body>

</html>
