<?php

$con = mysqli_connect( "localhost", "root", "", "shopyard" );  // Connecting to the DB

if ( ( $_SERVER['REQUEST_METHOD'] == 'POST' ) and ( isset( $_POST['reg_user'] ) ) ) {  // User Registration
    $fname = $_REQUEST['first-name'];
    $lname = $_REQUEST['last-name'];
    $email = $_REQUEST['email'];
    $pass = $_REQUEST['password'];

    $sql1 = "select * from user where email='".$email."'";
    $rs1 = mysqli_query( $con, $sql1 );
    $count1 = mysqli_num_rows( $rs1 );

    if ( $count1>0 ) {
        $_SESSION['toast_title'] = "Warning!";
		$_SESSION['toast_msg'] = "Email already exists. Try another one.";
		$_SESSION['toast_type'] = "warning";
		?>

		<?php require_once 'common/toast.php'; ?>
		<?php

    } else {
        $sql = "INSERT INTO `user`(`fname`, `lname`, `email`, `pass`) VALUES ('$fname','$lname','$email','$pass')";

        $rs = mysqli_query( $con, $sql );
        //execution of queries...
        if ( $rs == TRUE ) {   // Registration success
			$_SESSION['toast_title'] = "Success!";
			$_SESSION['toast_msg'] = "Registration is successful. Now please login.";
			$_SESSION['toast_type'] = "success";
			?>

			<?php require_once 'common/toast.php'; ?>
			<?php

        } else {  // Registration failure
			$_SESSION['toast_title'] = "Error!";
			$_SESSION['toast_msg'] = "Registration failed. Please try again.";
			$_SESSION['toast_type'] = "error";
			?>

			<?php require_once 'common/toast.php'; ?>
			<?php
        }

    }

}

if ( ( $_SERVER['REQUEST_METHOD'] == 'POST' ) and ( isset( $_POST['login_user'] ) ) ){  // User Login

	session_start();

    $email = $_REQUEST['email'];
    $password = $_REQUEST['pass'];

    $sql = "select * from user where email='".$email."' and pass='".$password."'";

    $rs = mysqli_query( $con, $sql );
    //execution of queries...
    $n = mysqli_num_rows( $rs );

    if ( $n>0 )  // Success
    {

        $_SESSION['user'] = $email;
		setcookie("firsttime", "no", /* EXPIRE */);
/*		$_SESSION['toast_title'] = "Success!";
		$_SESSION['toast_msg'] = "You logged in successfully.";
		$_SESSION['toast_type'] = "success";
		?>

		<?php require_once 'common/toast.php' ?>
		<?php */
        header( "location:index.php" );

    } else {  // Error
		$_SESSION['toast_title'] = "Error!";
		$_SESSION['toast_msg'] = "Invalid Login Credentials. Please try again.";
		$_SESSION['toast_type'] = "error";
		?>

		<?php require_once 'common/toast.php'; ?>
		<?php

    }

}

?>
