<?php

use App\Repository\UsersRepository;

if (isset($_POST['login_button'])) {
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //Sanitize email

	$_SESSION['log_email'] = $email; //Store email into session variable
	
	$password = md5($_POST['log_password']); //Get password
	//$password = password_hash($_POST['log_password'], PASSWORD_DEFAULT);

	foreach (UsersRepository::authenticateUser($email, $password) as $userRow) {

		if ($userRow == 1) {

			$username = $userRow->username;
			
			$checkUserStatus = UsersRepository::inquireStatus($email, 'yes');
			
			if (empty($checkUserStatus)) {
				UsersRepository::reactivateUser('no', $email);
			}

			$_SESSION['username'] = $username;
			header("Location: homepage.php");
			exit();
		}
		else {
			array_push($error_array, "Email or password was incorrect<br>");
		}
	}
}

?>