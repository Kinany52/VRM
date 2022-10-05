<?php

namespace App\Controller;

Class LogoutController
{
    /** @return void  */
    public function logout(): void
    {
        session_destroy();
        header("Location: /auth");
    }
}