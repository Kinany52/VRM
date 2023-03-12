<?php

namespace App\Controller;

use PDOException;
use Core\Http\Response;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;

Class DeletePostController
{   
    /**
     * @return Response 
     * @throws PDOException 
     */
    public function postDelete(): Response 
    {   
        
        if(isset($_GET['post_id']))
		$postId = $_GET['post_id'];
        //$postId = 2023;
        
        if(isset($_POST['result'])) {
            if($_POST['result'] == 'true') {
                //Validate post
                $postCheck = PostsRepository::validatePost($postId);
                if ($postCheck !== false)
                {
                    //Set post as deleted
                    PostsRepository::deletePost('yes', $postId);
                    //Update post count for user
                    $userLoggedIn = $_SESSION['username'];
                    $user = UsersRepository::queryUser($userLoggedIn);
                    $addedBy = $user['username'];
                    $numPosts = $user['num_posts'];
                    $numPosts--;
                    UsersRepository::aggregatePosts($numPosts, $addedBy);
                    return new Response(httpStatus: 200);
                } else {
                    //echo 'Invalid post cannot be deleted.';
                    return new Response(httpStatus: 400);
                }
                
            }
        }
        /*
        $template = new Template(__DIR__ . '/../View');
        $html = $template->render('DeletePostView.php', [
            'id' => $this->post_id
        ]);
        */
        //return new Response(httpStatus: 400);
    }
}