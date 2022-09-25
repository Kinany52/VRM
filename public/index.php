<?php

use Core\Router;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

bootstrap();

$router = new Router();

// Add the routes
$router->add('', ['controller' => 'HomepageController', 'action' => 'index']);
$router->add('pesto', ['controller' => 'HomepageController', 'action' => 'show']);
$router->add('auth', ['controller' => 'AuthenticationController', 'action' => 'authenticate']);
$router->add('profile', ['controller' => 'ProfileController', 'action' => 'index']);
$router->add('user_closed', ['controller' => 'UserClosedController', 'action' => 'index']);
$router->add('post', ['controller' => 'PostsController', 'action' => 'loadPostsFriends']);
$router->add('submit', ['controller' => 'PostsController', 'action' => 'submitPost']);
$router->add('logged_out', ['controller' => 'LogoutController', 'action' => 'logout']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);

echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';

/*
$controller = match ($_SERVER['REQUEST_URI'])
{
    '/' => function() {
        header("Location: files/homepage.php");
    }
    //'/addPost' => 
};
$controller();
*/