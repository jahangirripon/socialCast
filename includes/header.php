<?php

  require 'config/config.php';

  if(isset($_SESSION['username'])) 
  {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn ' ");
    $user = mysqli_fetch_array($user_details_query);
  } else
  {
    header("Location: register.php");
  }

	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>SocialCast</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
	</head>

  <body>

    <div class="top_bar">
      <div class="logo">
        <a href="index.php">SocialCast</a>
      </div>
      <nav>
        <a href="<?php echo $userLoggedIn; ?>">
          <?php echo $user['first_name']; ?>
        </a>
        <a href="#">two</a>
        <a href="includes/handlers/logout.php">Logout</a>
      </nav>
    </div>

    <div class="wrapper">
