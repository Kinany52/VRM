<?php

namespace App\Controller;

use App\Repository\PostsRepository;
use App\Repository\UsersRepository;

Class DeletePostController
{
    public function postDelete( ) {

        if(isset($_GET['post_id']))
		$post_id = $_GET['post_id'];

        if(isset($_POST['result'])) {
            if($_POST['result'] == 'true') {
                PostsRepository::deletePost('yes', $post_id);
                //Update post count for user
                $userLoggedIn = $_SESSION['username'];
                $userArray = UsersRepository::queryUser($userLoggedIn);
                $added_by = $userArray['username'];
                $num_posts = $userArray['num_posts'];
                $num_posts--;
                UsersRepository::aggregatePosts($num_posts, $added_by);
            }
        }
    }
}