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
     * @var array<mixed> $profileUser
     */
    public array $profileUser = [];

    /**
     * @return Response 
     * @throws PDOException 
     * @throws Exception 
     */
    public function index(): Response 
    {

        if (isset($_SESSION['username'])) {
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
            $profileUsername = $_GET['profile_username'];
            $this->profileUser = UsersRepository::queryUser($profileUsername);
        }
          
        if (isset($this->profileUser['user_closed'])) {
            if ($this->profileUser['user_closed'] == 'yes') {
            return (new Response(302))->addHeader(
                new Header(
                    name: 'Location', value: '/user_closed'
                )
            );
            }
        }
        
        $template = new Template(__DIR__ . '/../View');
        $html = $template->render('ProfileView.php', [
            'profileUser' => $this->profileUser,
            'user' => $user
        ]);

        return new Response(content: $html);
    }
}