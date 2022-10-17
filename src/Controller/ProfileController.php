<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Core\Template;
use PDOException;
use Exception;

Class ProfileController
{
    /**
     * Array of user data (here only username required)
     * @var array<string> $userArray
     */
    public array $userArray = [];

    /**
     * @return void 
     * @throws PDOException 
     * @throws Exception 
     */
    public function index(): void
    {

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
              header("Location: /user_closed");
        }
        
        $template = new Template('../src/View');
        echo $template->render('ProfileView.php', [
            'userArray' => $this->userArray,
            'user' => $user
        ]);
    }
}