<?php

namespace App\Controller;

use App\Controller\Post;
use App\Library\PDO;
use App\Repository\UsersRepository;
use Core\BaseController;

Class HomepageController extends BaseController
{
    public function index() {
        header("Location: files/homepage.php");
    }

    public function show() {
        echo 'Hello from show method!';
    }
}