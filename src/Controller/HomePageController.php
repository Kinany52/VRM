<?php

namespace App\Controller;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\Post;
use App\Library\PDO;
use App\Repository\UsersRepository;
use Core\BaseController;
use Core\Template;
use App\Controller\AuthenticationController;

Class HomepageController
{
    public function index() {
        if(isset($_SESSION['username'])) {
            $userLoggedIn = $_SESSION['username'];
	        $user = UsersRepository::queryUser($userLoggedIn);
        } else {
            $auth = new AuthenticationController();
            return $auth->authenticate();
        }
        if(isset($_POST['post'])){
            var_dump($_POST['post']);
            $post = new Post(PDO::instance(), $userLoggedIn);
            $post->submitPost($_POST['post_text']);
            //header("Location: homepage.php"); //Stops the form resubmitting on refresh (duplicate announcement prevention).
        }
        $template = new Template('../src/View');
        echo $template->render('HomepageView.php', [
            'user' => $user
        ]);
    }

    public function show() {
        echo 'Hello from show action method!';
        //return $this->index(); //testcalling method action from same controller
        //$teto = new AuthenticationController;
        //return $teto->authenticate(); //testcalling method action from different controller
    }
}