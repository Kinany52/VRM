<?php 

use App\Controller\User;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use App\Library\PDO;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

bootstrap();

	if(isset($_GET['post_id']))
		$post_id = $_GET['post_id'];

	if(isset($_POST['result'])) {
		if($_POST['result'] == 'true')
			PostsRepository::deletePost('yes', $post_id);
			//Update post count for user
			$user = $userLoggedIn = $_SESSION['username'];
			$userObj = new User(PDO::instance(), $user);
			$added_by = $userObj->getUsername();
			$num_posts = $userObj->getNumPosts();
			$num_posts--;
			UsersRepository::aggregatePosts($num_posts, $added_by);
	}