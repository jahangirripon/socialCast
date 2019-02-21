<?php

	$con = mysqli_connect("localhost", "root", "", "socialcast");

	if(mysqli_connect_errno()) 
	{
		echo "Failedto connect".mysqli_connect_errno();
	}

	//$query = mysqli_query();

	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>SocialCast</title>
	</head>
	<body>
		Welcome to SocialCast
	</body>
	</html>