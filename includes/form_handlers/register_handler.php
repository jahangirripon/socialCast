<?php

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
			array_push($error_array, 'Emails dont match!');
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
				array_push($error_array, "Password does not match!");
			} else {
				if(preg_match('/^A-Za-z0-9/', $password)) {
					array_push($error_array, "Your pass can only contain english letters and numbers<br>");
				}
			}

		if(strlen($password) > 30 || strlen($password) < 5)
		{
				array_push($error_array, "Password must be between 5 and 30 chars!<br>");
		}

		if(empty($error_array)) {
			$password = md5($password); //encrypt password

			
			$username = strtolower($fname."_".$lname); // generate username
			$check_username_query = mysqli_query($con, "SELECT username from users WHERE username='$username' ");

				
				$num_rows = mysqli_num_rows($check_username_query); // count no of rows returns

				$i = 0; // if username exists, add number to username
				

				while(mysqli_num_rows($check_username_query) != 0) {
					$i++; // add 1 to i
					$username = $username.'_'.$i;
					$check_username_query = mysqli_query($con, "SELECT 	username FROM users WHERE username='$username' ");

				}

				

				// profile picture
				$rand = rand(1,2);

				if($rand == 1)
					$profile_pic = "assets/images/profile_pics/defaults/creative.png";
				
				 else if ($rand == 2) 
					$profile_pic = "assets/images/profile_pics/defaults/target.png";
				

				// $query = mysqli_query($con, "INSERT INTO users 
				// 	(first_name, last_name, username, email, password, signup_date, profile_pic, num_posts, num_likes, user_closed, friend_array) 
				// 	VALUES ($fname', '$lname', '$username','$em', '$password', '$date', '$profile_pic', '0', '0' 'no', ',' )");

				// array_push($error_array, "<span> All set, login now! </span><br>");

				// // clear session variables
				// $_SESSION['reg_fname'] = "";
				// $_SESSION['reg_lname'] = "";
				// $_SESSION['reg_email'] = "";
				// $_SESSION['reg_email2'] = "";

				// $query = mysqli_query($con, "INSERT INTO users (first_name, last_name, username, email, password, signup_date, profile_pic, num_posts, num_likes, user_closed, friend_array) VALUES ('', '$fname', '$lname', '$username','$em', '$password', '$data', '$profile_pic', '0', '0' 'no', ',' )");
		}

		$username = strtolower($fname."_".$lname); 
		$profile_pic = "assets/images/profile_pics/defaults/creative.png";

		$query = mysqli_query($con, "INSERT INTO users 
			(id, first_name, last_name, username, email, password, signup_date, profile_pic, num_posts, num_likes, user_closed, friend_array) 
			VALUES ('','$fname', '$lname', '$username','$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',' )");
		echo "hi";

		print_r($query);

		array_push($error_array, "<span> All set, login now! </span><br>");

		// clear session variables
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";

	}


?>