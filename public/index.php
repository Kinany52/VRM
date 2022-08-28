<?php

use App\Controller\AuthenticationController;
use App\Controller\HomePageController;
use App\Library\PDO;
use App\Repository\UsersRepository;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$controller = match ($_SERVER['REQUEST_URI'])
{
    '/' => function() {
        header("Location: files/homepage.php");
    },
    '/register.php' => function() { 
        echo 'Hello from register.php';
    },
    default => function() {
        dump($_SERVER);
    },
};
$controller(); 

//$controller->index();
//$HPController = new HomePageController($_SERVER);
//$authentication = new AuthenticationController($_SERVER);

//$HPController->index();
//$authentication->authenticate();
//$authentication->handleRegister();
//$authentication->handleLogin();
