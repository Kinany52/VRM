<?php

Namespace App\Controller;

use App\Repository\UsersRepository;
use Core\Template;

Class ProfileController
{

    public array $userArray = [];

    public function index() {

        if(isset($_SESSION['username'])) {
            $userLoggedIn = $_SESSION['username'];
	        $user = UsersRepository::queryUser($userLoggedIn);
        } else {
            header("Location: /auth");
        }

        if (isset($_GET['profile_username'])) {
            $username = $_GET['profile_username'];
            $this->userArray = UsersRepository::queryUser($username);
        }
          
        if ($this->userArray['user_closed'] == 'yes') {
              header("Location: user_closed.php");
        }
        
        $template = new Template('../src/View');
        echo $template->render('ProfileView.php', [
            'userArray' => $this->userArray,
            'user' => $user
        ]);
    }
}