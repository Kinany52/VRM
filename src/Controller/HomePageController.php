<?php

namespace App\Controller;

use App\Controller\Post;
use App\Library\PDO;
use App\Repository\UsersRepository;

Class HomePageController
{
    public function index() {
        
        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'index.php';
    }
}