<?php
	if (($_SERVER['REQUEST_METHOD']=='POST') and (isset($_POST['submit']))) {
		$msg_body = '';

		$msg_body .= 'Name: '.$_REQUEST['f-name'];
		$msg_body .= ' '.$_REQUEST['l-name'];
		$msg_body .= ',\n Email: '.$_REQUEST['email'];
		$title = $_REQUEST['title'];
		$msg_body .= ',\n Message: '.$_REQUEST['msg'];

		$to = "karsubhajit01@gmail.com";

		// Sending email
//		mail($to, $title, $msg_body);
		$_SESSION['toast_title'] = "Success!";
		$_SESSION['toast_msg'] = "Email sent successfully.";
		$_SESSION['toast_type'] = "success";
		?>

			<?php require_once 'common/toast.php'; ?>
		<?php
	}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | ShopYard</title>

    <!--Bootstrap library css cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Font Awesome library for all the modern project icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Bootstrap js library cdn-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS StyleSheets -->
    <link rel="stylesheet" href="css/contact.css">
</head>

<body>
    <!-------- Header (Toolbar & Navigation Bar)------------>
    <?php
        include 'common/header.php'; ?>

    <section>
        <div class="container">
            <!------- Business location, contact info & social ---------->
            <div class="contactInfo">
                <div>
                    <h2> Contact Info</h2>
                    <hr>
                    <ul class="info">
                        <li>
                            <span><img src="icon/location.png"></span>
                            <span>Jhinga, Diamond Harbour Road, P.O. Amira, South 24 paraganas West Bengal, India<br>743368</span>
                        </li>
                        <li>
                            <span><img src="icon/mail.png"></span>
                            <span>support@shopyard.co.in</span>

                        </li>
                        <li>
                            <span><img src="icon/call.png"></span>
                            <span>+91-12345 67890</span>
                        </li>
                    </ul>
                </div>
                <ul class="social">
                    <li><a href="https://facebook.com" target="_blank" rel="noopener noreferrer"><img src="icon/fb.png"></a></li>
                    <li><a href="https://instagram.com" target="_blank" rel="noopener noreferrer"><img src="icon/insta.png"></a></li>
                    <li><a href="https://linkedin.com" target="_blank" rel="noopener noreferrer"><img src="icon/linkedin.png"></a></li>
                    <li><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="icon/twitter.png"></a></li>
                    <li><a href="https://pinterest.com" target="_blank" rel="noopener noreferrer"><img src="icon/pinterest.png"></a></li>
                </ul>
            </div>

            <!------- Contact form ---------->
            <div class="contactForm">
                <h2>Send a Message</h2>
                <form name="contact-form" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
					<div class="formBox">
                    <div class="inputBox w50">
                        <input type="text" name="f-name" required>
                        <span>First Name</span>
                    </div>
                    <div class="inputBox w50">
                        <input type="text" name="l-name" required>
                        <span>Last Name</span>
                    </div>
                    <div class="inputBox w50">
                        <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        <span>Email Address</span>
                    </div>
                    <div class="inputBox w50">
                        <input type="text" name="title" required>
                        <span>Short Title (what's this all about?)</span>
                    </div>
                    <div class="inputBox w100">
                        <textarea name="msg" required></textarea>
                        <span>Write your message here...</span>
                    </div>
                    <div class="inputBox w100">
                        <input type="submit" name="submit" value="Send">
                    </div>
                </div>
				</form>
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
