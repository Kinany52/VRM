<?php

namespace App\Controller;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\PostsController;
use App\Library\PDO;
use App\Repository\UsersRepository;
use Core\Template;

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
            $post = new PostsController(PDO::instance(), $userLoggedIn);
            $post->submitPost($_POST['post_text']);
            header("Location: /"); //Stops the form resubmitting on refresh (duplicate announcement prevention).
        }
        $template = new Template('../src/View');
        echo $template->render('HomepageView.php', [
            'user' => $user
        ]);
    }
}