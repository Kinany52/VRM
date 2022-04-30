<?php

use App\Library\PDO;

if (isset($_POST['login_button'])) {
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //Sanitize email

	$_SESSION['log_email'] = $email; //Store email into session variable
	
	$password = md5($_POST['log_password']); //Get password

	$check_database_query = PDO::instance()->prepare("SELECT * FROM users WHERE email=? AND password=?");
	
	$check_database_query->execute([$email, $password]);
	
	$check_login_query = $check_database_query->fetch();

	if ($check_database_query->rowCount() == 1) {

		$username = $check_login_query['username'];

		$user_closed_query = PDO::instance()->prepare("SELECT * FROM users WHERE email=? AND user_closed=?");
		$user_closed_query->execute([$email, 'yes']);
		$user_closed_query_count = $user_closed_query->fetch();
		
		if (empty($user_closed_query_count)) {
			$reopen_account = PDO::instance()->prepare("UPDATE users SET user_closed=? WHERE email=?");
			$reopen_account->execute(['no', $email]);
		}

		$_SESSION['username'] = $username;
		header("Location: index.php");
		exit();
	}
	else {
		array_push($error_array, "Email or password was incorrect<br>");
	}
}

?>