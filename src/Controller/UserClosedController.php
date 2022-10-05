<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Core\Template;
use PDOException;
use Exception;

Class UserClosedController
{
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

        $template = new Template('../src/View');
        echo $template->render('UserClosedView.php', [
            'user' => $user
        ]);
    }            
}