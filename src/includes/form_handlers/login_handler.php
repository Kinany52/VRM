<?php

use App\Entity\PDO;

if (isset($_POST['login_button'])) {
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //Sanitize email

	$_SESSION['log_email'] = $email; //Store email into session variable
	
	$password = md5($_POST['log_password']); //Get password

	$check_database_query = PDO::run("SELECT * FROM users WHERE email=? AND password=?", [$email, $password]);
	//var_export($check_database_query);
	
	$check_login_query = $check_database_query->fetchAll();

	//$check_login_query = $check_database_query->rowCount();
	//dd($check_login_query);

	if (count($check_login_query) == 1) {
		//$row = fetch($check_database_query);
		$username = $check_login_query['username'];

		$user_closed_query = PDO::run("SELECT * FROM users WHERE email=? AND user_closed=?", [$email, 'yes'])->fetch();
		//var_export($user_closed_query);
		
		if (count($user_closed_query) == 1) {
			$reopen_account = PDO::run("UPDATE users SET use_closed=? WHERE email=?", ['no', $email]);
			//var_dump($reopen_account);
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