<?php

Namespace App\Controller;

use App\Repository\UsersRepository;

Class SessionController
{
    public function validateSession() {
        if (isset($_SESSION['username'])) {
            $userLoggedIn = $_SESSION['username'];
            $user = UsersRepository::queryUser($userLoggedIn);
            }
        else {
            //header("Location: register.php");
            echo "Hello from right here.<br>";
        }
    }
}