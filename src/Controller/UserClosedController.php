<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Core\Template;

Class UserClosedController
{
    public function index() {
        if(isset($_SESSION['username'])) {
            $userLoggedIn = $_SESSION['username'];
	        $user = UsersRepository::queryUser($userLoggedIn);
        } else {
            header("Location: /auth");
        }

        $template = new Template('../src/View');
        echo $template->render('UserClosedView.php', [
            'user' => $user
        ]);
    }            
}