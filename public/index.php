<?php

use Core\Application;
use Core\Router;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

bootstrap();

$router = new Router();
$application = new Application($router);
$application->handleRequest($_SERVER);

//echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';
//$uri = $_SERVER['REQUEST_URI'];
//$status = $_SERVER;
//var_dump($status);

//$rata = http_response_code(404);
//var_dump($rata);

//$taki = new Application($router);
//$jaki = $application->handleRequest($_SERVER);
//$zaki = var_dump($taki);