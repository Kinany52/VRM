<?php

use App\Controller\AuthenticationController;

session_start();
session_destroy();
$auth = new AuthenticationController();
return $auth->authenticate();
//header("Location: ../register.php");
 ?>