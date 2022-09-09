<?php

namespace App\Controller;

//require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\Post;
use App\Library\PDO;
use App\Repository\UsersRepository;
use Core\BaseController;
use Core\Template;

Class HomepageController extends BaseController
{
    public function index() {
        $userLoggedIn = "wojciech_gula";
	    $user = UsersRepository::queryUser($userLoggedIn);
        if(isset($_POST['post'])){
            $post = new Post(PDO::instance(), $userLoggedIn);
            $post->submitPost($_POST['post_text']);
            //header("Location: homepage.php"); //Stops the form resubmitting on refresh (duplicate announcement prevention).
        }
        $template = new Template('../src/View');
        echo $template->render('HomepageView.php', [
            'user' => $user
        ]);
        
        //header("Location: files/homepage.php");
    }

    public function show() {
        echo 'Hello from show method!';
    }
}