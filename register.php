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
	$error_array = ""; // error_array

	if(isset($_POST['register_button']))
	{
		//  register form values

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

		if($em == $em2)
		{
			// check if email is valid
			if(filter_var($em, FILTER_VALIDATE_EMAIL))
			{
				$em = filter_var($em, FILTER_VALIDATE_EMAIL);

				// check if e-mail exists

				$e_check =  mysqli_query($con, "SELECT email from users WHERE email='$em' ");

				// count no of rows returns
				$num_rows = mysqli_num_rows($e_check);
				if($num_rows > 0)
				{
					array_push($error_array, "Email already in use<br>");
				}
			}
			else
			{
				array_push($error_array, 'Invalid e-mail format!<br>');
			}

		}

		else 
		{
			echo 'Emails dont match!';
		}


			if(strlen($fname) > 25 || strlen($fname) < 2)

			{
				array_push($error_array, "First name must be between 2 and 25 chars!<br>");
			}

			if(strlen($lname) > 25 || strlen($lname) < 2)

			{
				array_push($error_array, "Last name must be between 2 and 25 chars!<br>");
			}

			if($password != $password2)

			{
				echo "Password does not match!";
			} else {
				if(preg_match('/^A-Za-z0-9/', $password)) {
					array_push($error_array, "Your pass can only contain english letters and numbers<br>");
				}
			}

		if(strlen($password) > 30 || strlen($password) < 5)

			{
				array_push($error_array, "Last password must be between 5 and 30 chars!<br>");
			}

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
		<input type="text" name="reg_fname" placeholder="First Name" value="
		<?php
			if(isset($_SESSION['reg_fname'])) {
				echo $_SESSION['reg_fname'];
			}
		?>" required>
		<br>
		<input type="text" name="reg_lname" placeholder="Last Name" value="
		<?php
			if(isset($_SESSION['reg_lname'])) {
				echo $_SESSION['reg_lname'];
			}
		?>" required>
		<br>

		<input type="text" name="reg_email" placeholder="E-mail" value="
		<?php
			if(isset($_SESSION['reg_email'])) {
				echo $_SESSION['reg_email'];
			}
		?>" required>
		<br>
		<input type="text" name="reg_email2" placeholder="Confirm email" value="
		<?php
			if(isset($_SESSION['reg_email2'])) {
				echo $_SESSION['reg_email2'];
			}
		?>" required>
		<br>

		<input type="password" name="reg_password" placeholder="Password" required>
		<br>
		<input type="text" name="reg_password2" placeholder="Confirm password" required>
		<br>

		<input type="submit" name="register_button" value="Register">



	</form>
</body>
</html>