<?php

if (!function_exists("config")) {

	function config() {

		$timezone = date_default_timezone_set("Europe/Berlin");

		$con = mysqli_connect("localhost", "root", "", "social"); //Connection variable

		if(mysqli_connect_errno()) {
				throw new \Exception("Failed to connect:", mysqli_connect_errno());
		}

		return $con;
	}

}

if (!function_exists("bootstrap")) {
	function bootstrap() {
		session_start();
		ob_start();
	}
}

?>