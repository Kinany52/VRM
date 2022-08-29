<?php

use App\Repository\UsersRepository;

if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user = UsersRepository::validateSession($userLoggedIn);
	}
else {
	header("Location: register.php");
}

 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Vendor Return Management</title>

		<!-- JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="/assets/js/bootstrap.js"></script>
		<script src="/assets/js/bootbox.min.js"></script>
		
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/style.css">

	</head>
	
	<body>

		<div class="top_bar">
			
			<div class="logo">
				<a id="GFG" href="homepage.php">Vendor Return Management</a>
			</div>

			<nav>
				<a id="GFGN" href="profile.php?profile_username=<?php echo $userLoggedIn; ?>">Hi there, <?php echo $user['first_name']; ?>!</a>
				<a id="GFG" href="handlers/logout.php">Logout</a>
			</nav>

		</div>

		<div class="wrapper">
		