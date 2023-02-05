<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Core\Http\Response;
use Core\Template;
use PDOException;
use Exception;

Class UserClosedController
{
    /**
     * @return Response
     * @throws PDOException 
     * @throws Exception 
     */
    public function index(): Response
    {
        if(isset($_SESSION['username'])) {
            $userLoggedIn = $_SESSION['username'];
	        $user = UsersRepository::queryUser($userLoggedIn);
        } else {
            header("Location: /auth");
        }

        $template = new Template('../src/View');
        $html = $template->render('UserClosedView.php', [
            'user' => $user
        ]);
        return new Response(content: $html);
    }            
}