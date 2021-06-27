<?php
	// Saving the values to the vars
	$title = $_SESSION['toast_title'];
	$msg = $_SESSION['toast_msg'];
	$type = $_SESSION['toast_type'];
	// Clearing the session params

	$style_str = 'style="padding: 2rem;color: white;display: flex;float: right;margin-bottom: 2rem;font-size: 1.6rem;position: absolute;top: 0;right: 0;font-family: sans-serif;text-align: center;border-radius: .5rem;box-shadow: 0 0 1rem rgba(0, 0, 0, 0.2);width: 50rem;z-index:10;';
	switch($type){
		case "success":
			$style_str .= 'background-color: green;"';
			break;
		case "error":
			$style_str .= 'background-color: #f44336;"';
			break;
		case "warning":
			$style_str .= 'background-color: orange;"';
			break;
		default:
			$style_str .= 'style="background-color: dimgray;"';
	}
?>

<div class="alert" <?php echo $style_str; ?> >
		<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
		<strong><?php echo $title; ?></strong> <?php echo $msg; ?>
</div>
