<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Core\Template;
use App\Controller\PostsController;

Class HomepageController
{
    public function index() {
        if(isset($_SESSION['username'])) {
            $userLoggedIn = $_SESSION['username'];
	        $user = UsersRepository::queryUser($userLoggedIn);
        } else {
            header("Location: /auth");
        }
        if(isset($_POST['post'])){
            $post = new PostsController();
            $post->submitPost($_POST['post_text']);
            header("Location: /"); //Stops the form resubmitting on refresh (duplicate announcement prevention).
        }
        $template = new Template('../src/View');
        echo $template->render('HomepageView.php', [
            'user' => $user
        ]);
    }
}