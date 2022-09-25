<?php

namespace App\Controller;

Class LogoutController
{
    public function logout() {
        session_destroy();
        header("Location: /auth");
    }
}