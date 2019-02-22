<?php

	session_start();

	$con = mysqli_connect("localhost", "root", "", "socialcast");

	if(mysqli_connect_errno()) 
	{
		echo "Failed to connect".mysqli_connect_errno();
	}

	//  declaring variables to prevent errors
	$fname = ""; // first name
	$lname = ""; // last name
	$em = ""; // email
	$em2 = ""; // email2
	$password = ""; // password
	$password2 = ""; // password2
	$date = ""; // signup date
	$error_array = []; // error_array

	if(isset($_POST['register_button']))
	{

		// frist name
		$fname = strip_tags($_POST['reg_fname']); // remove html tags
		$fname = str_replace(' ', '', $fname); // remove spaces
		$fname = ucfirst(strtolower($fname)); // upprecase first letter

		$_SESSION['reg_fname'] = $fname;

		// last name
		$lname = strip_tags($_POST['reg_lname']); // remove html tags
		$lname = str_replace(' ', '', $lname); // remove spaces
		$lname = ucfirst(strtolower($lname)); // upprecase first letter

		$_SESSION['reg_lname'] = $lname;

		// email
		$em = strip_tags($_POST['reg_email']); // remove html tags
		$em = str_replace(' ', '', $em); // remove spaces

		$_SESSION['reg_email'] = $em;

		// email2
		$em2 = strip_tags($_POST['reg_email2']); // remove html tags
		$em2 = str_replace(' ', '', $em2); // remove spaces

		$_SESSION['reg_email2'] = $em2;

		// password
		$password = strip_tags($_POST['reg_password']); // remove html tags

		// confirm password
		$password2 = strip_tags($_POST['reg_password2']); // remove html tags

		$date = date("Y-m-d"); // current date

		// $name = $_POST['name'];
		// $user_id = $_POST['user_id'];
		// $sql = "INSERT INTO user (name, user_id) VALUES ('$name', '$user_id')";
		// $result = mysqli_query($conn, $sql);

		$password = md5($password); //encrypt password
		$username = strtolower($fname."_".$lname); // generate username
		$profile_pic = "assets/images/profile_pics/defaults/creative.png";

		$insert = "INSERT INTO profiles (first_name, last_name, username, email, password, signup_date, profile_pic, num_posts, num_likes, user_closed, friend_array) VALUES ('$fname', '$lname', '$username','$em', '$password', '$date', '$profile_pic', '0', '0' ,'no', 'test' )";

		$query = mysqli_query($con, $insert);

		//var_dump($insert);

		// clear session variables
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";

	}

	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register | SocialCast</title>
</head>
<body>
	<form action="register.php" method="POST">


		<input type="text" name="reg_fname" placeholder="First Name" value="<?php
			if(isset($_SESSION['reg_fname'])) {echo $_SESSION['reg_fname'];}
		?>" required>
		<br>
		<?php
			if(in_array("First name must be between 2 and 25 chars!<br>",  $error_array)) {
				echo "First name must be between 2 and 25 chars!<br>";
			}
		?>


		<input type="text" name="reg_lname" placeholder="Last Name" value="<?php
			if(isset($_SESSION['reg_lname'])) {
				echo $_SESSION['reg_lname'];
			}
		?>" required>
		<br>
		<?php
			if(in_array("Last name must be between 2 and 25 chars!<br>", $error_array)) {
				echo "Last name must be between 2 and 25 chars!<br>";
			}
		?>


		<input type="text" name="reg_email" placeholder="E-mail" value="<?php
			if(isset($_SESSION['reg_email'])) {
				echo $_SESSION['reg_email'];
			}
		?>" required>
		<br>
		<?php
			if(in_array("Email already in use<br>", $error_array)) {
				echo "Email already in use<br>";
			}
		?>


		<input type="text" name="reg_email2" placeholder="Confirm email" value="<?php
			if(isset($_SESSION['reg_email2'])) {
				echo $_SESSION['reg_email2'];
			}
		?>" required>
		<br>
		<?php
			if(in_array("Email already in use<br>", $error_array)) {
				echo "Email already in use<br>";
			}
		?>

		<input type="password" name="reg_password" placeholder="Password" required>
		<br>
		<?php
			if(in_array("Email already in use<br>", $error_array)) {
				echo "Email already in use<br>";
			}
		?>


		<input type="password" name="reg_password2" placeholder="Confirm password" required>
		<br>
		<?php
			if(in_array("Password must be between 5 and 30 chars!<br>", $error_array)) {
				echo "Password must be between 5 and 30 chars!<br>";
			}
		?>

		<input type="submit" name="register_button" value="Register">
		
		<?php
			if(in_array("<span> All set, login now! </span><br>", $error_array)) {
				echo "<span> All set, login now! </span><br>";
			}
		?>

	</form>
</body>
</html>