<?php

namespace App\Controller;

use Exception;
use PDOException;
use Core\Template;
use Core\Http\Header;
use Core\Http\Response;
use App\Repository\UsersRepository;

Class ProfileController
{
    /**
     * Array of user data (here only username required)
     * @var array<string> $userArray
     */
    public array $userArray = [];

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
            return (new Response(302))->addHeader(
                new Header(
                    name: 'Location', value: '/auth'
                )
            );
        }

        if (isset($_GET['profile_username'])) {
            $username = $_GET['profile_username'];
            $this->userArray = UsersRepository::queryUser($username);
        }
          
        if ($this->userArray['user_closed'] == 'yes') {
            return (new Response(302))->addHeader(
                new Header(
                    name: 'Location', value: '/user_closed'
                )
            );
        }
        
        $template = new Template('../src/View');
        $html = $template->render('ProfileView.php', [
            'userArray' => $this->userArray,
            'user' => $user
        ]);

        return new Response(content: $html);
    }
}