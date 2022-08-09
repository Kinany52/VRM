<?php 

use App\Att\User;
use App\Att\Post;
use App\Library\PDO;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$limit = 10; //Number of posts to be loaded per call

$posts = new Post(PDO::instance(), $_REQUEST['userLoggedIn']);
$posts->loadProfilePosts($_REQUEST, $limit);

 ?>