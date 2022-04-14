<?php

if (!function_exists("config")) {

	function config() {

		$timezone = date_default_timezone_set("Europe/Berlin");

		define('DB_HOST', 'mysql');
		define('DB_NAME', 'social');
		define('DB_USER', 'root');
		define('DB_PASS', 'pass');
		define('DB_CHAR', 'utf8');
	}

}

if (!function_exists("bootstrap")) {
	function bootstrap() {
		session_start();
		ob_start();
	}
}

?>