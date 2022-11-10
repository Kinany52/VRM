<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use App\Controller\SubmitPostController;
use Core\Template;
use Exception;

Class HomepageController
{
    /**
     * @return void 
     * @throws Exception 
     */
    public function index(): void
    {
        if(isset($_SESSION['username'])) {
            $userLoggedIn = $_SESSION['username'];
	        $user = UsersRepository::queryUser($userLoggedIn);
        } else {
            header("Location: /auth");
            return;
        }
        if(isset($_POST['post'])){
            $post = new SubmitPostController();
            $post->submitPost($_POST['post_text']);
            header("Location: /"); //Stops the form resubmitting on refresh (duplicate announcement prevention).
        }
        $template = new Template('../src/View');
        echo $template->render('HomepageView.php', [
            'user' => $user
        ]);
    }
}