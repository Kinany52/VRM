<?php

use App\Repository\UsersRepository;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

bootstrap();

include("handlers/header.php");

if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user = UsersRepository::queryUser($userLoggedIn);
	}
else {
	header("Location: register.php");
}
 ?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<div class="main_column column" id="main_column">
			<h4>User Closed</h4>
			<h9>This account is closed.</h9>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<a href="homepage.php"> Click here to go back.</a>
		</div>
	</body>
</html>