<?php
	// Saving the values to the vars
	$title = $_SESSION['toast_title'];
	$msg = $_SESSION['toast_msg'];
	$type = $_SESSION['toast_type'];
	// Clearing the session params
	unset($_SESSION['toast_title']);
	unset($_SESSION['toast_msg']);
	unset($_SESSION['toast_type']);

	$style_str = "";
	switch($type){
		case "success":
			$style_str = 'style="background-color: green;"';
			break;
		case "error":
			$style_str = 'style="background-color: #f44336;"';
			break;
		case "warning":
			$style_str = 'style="background-color: orange;"';
			break;
		default:
			$style_str = 'style="background-color: dimgray;"';
	}
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="css/toast.css">
</head>

<body>
	<div class="alert" <?php echo $style_str; ?> >
		<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
		<strong><?php echo $title; ?></strong> <?php echo $msg; ?>
	</div>
</body>

</html>
