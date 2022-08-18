<?php

use App\Controller\User;
use App\Controller\Post;
use App\Library\PDO;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$limit = 10; //Number of posts to be loaded per call

$posts = new Post(PDO::instance(), $_REQUEST['userLoggedIn']);
$posts->loadPostsFriends($_REQUEST, $limit);

 ?>