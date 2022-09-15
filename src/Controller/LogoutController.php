<?php

Namespace App\Controller;

use App\Controller\AuthenticationController;

Class LogoutController
{
    public function logout() {
        session_destroy();
        header("Location: /auth");
        //$auth = new AuthenticationController();
        //return $auth->authenticate();
        //die();
        //header("Location: ../register.php");    
    }
}