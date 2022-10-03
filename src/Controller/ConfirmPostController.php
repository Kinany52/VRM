<?php

namespace App\Controller;

use App\Entity\LikesEntity;
use App\Repository\LikesRepository;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use Core\Template;

Class ConfirmPostController
{
    public function confirmPost() {
        if (isset($_SESSION['username'])) {
            $userLoggedIn = $_SESSION['username'];
        }
        else {
            header("Location: /auth");
        }
        
        //Get id of post
        if(isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
        }
        
        foreach (PostsRepository::getLikes($post_id) as $previousLikes) {
            $total_likes = $previousLikes->likes;
        }
        
        foreach (PostsRepository::getPoster($post_id) as $poster) {
            $user_liked = $poster->added_by;
        }
        
        foreach (UsersRepository::getNumLikes($user_liked) as $likesnumber) {
            $total_user_likes = $likesnumber->num_likes;
        }
        
        //Like button
        if(isset($_POST['like_button'])) {
            $total_likes++;
            $updateLikes = PostsRepository::updateLikes($total_likes, $post_id);
            $total_user_likes++;
            UsersRepository::aggregateLikes($total_user_likes, $user_liked);
            LikesRepository::persistEntity(new LikesEntity(
                username: $userLoggedIn, 
                post_id: $post_id
            ));
        }
        //Unlike button
        if(isset($_POST['unlike_button'])) {
            $total_likes--;
            $updateUnlikes = PostsRepository::updateLikes($total_likes, $post_id);
            $total_user_likes--;
            UsersRepository::aggregateLikes($total_user_likes, $user_liked);
            LikesRepository::dislike($userLoggedIn, $post_id);
        }
        //Check for previous likes by the currently-loggedin user.
        $num_rows = LikesRepository::getRowLikes($userLoggedIn, $post_id);

        $template = new Template('../src/View');
        echo $template->render('ConfirmPostView.php', [
            'num_rows' => $num_rows,
            'post_id' => $post_id,
            'total_likes' => $total_likes
        ]);
    }
}