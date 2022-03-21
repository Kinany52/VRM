<?php

use App\Entity\PDO;

if (isset($_POST['login_button'])) {
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //Sanitize email

	$_SESSION['log_email'] = $email; //Store email into session variable
	
	$password = md5($_POST['log_password']); //Get password

	$check_database_query = PDO::run("SELECT * FROM users WHERE email=? AND password=?", [$email, $password])->fetch();
	var_export($check_database_query);

	$check_login_query = PDOstatement::rowCount($check_database_query);

	if ($check_login_query == 1) {
		$row = fetch($check_database_query);
		$username = $row['username'];

		$user_closed_query = PDO::run("SELECT * FROM users WHERE email=? AND user_closed=?", [$email, 'yes'])->fetch();
		var_export($user_closed_query);
		
		if (PDOstatement::rowCount($user_closed_query) == 1) {
			$reopen_account = PDO::run("UPDATE users SET use_closed=? WHERE email=?", ['no', $email]);
			var_dump($reopen_account);
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