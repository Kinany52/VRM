<?php

namespace App\Controller;

use Exception;
use PDOException;
use Core\Template;
use Core\Http\Header;
use Core\Http\Response;
use App\Entity\LikesEntity;
use App\Repository\LikesRepository;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;

Class ConfirmPostController
{
    /**
     * @var int $this->post_id
     */
    public int $post_id = 0;

     /**
     * @var string $this->user_liked
     */
    public string $user_liked = '';

    /**
     * @var int $this->total_likes
     */
    public int $total_likes = 0;

    /**
     * @return Response 
     * @throws PDOException 
     * @throws Exception 
     */
    public function confirmPost(): Response 
    {
        if (isset($_SESSION['username'])) {
            $userLoggedIn = $_SESSION['username'];
        }
        else {
            return (new Response(302))->addHeader(
                new Header(
                    name: 'Location', value: '/auth'
                )
            );
        }
        
        //Get id of post
        if(isset($_GET['post_id'])) {
            $this->post_id = $_GET['post_id'];
        }
        
        foreach (PostsRepository::getLikes($this->post_id) as $previousLikes) {
            $this->total_likes = $previousLikes->likes;
        }
        
        foreach (PostsRepository::getPoster($this->post_id) as $poster) {
            $this->user_liked = $poster->added_by;
        }
        
        foreach (UsersRepository::getNumLikes($this->user_liked) as $likesnumber) {
            $total_user_likes = $likesnumber->num_likes;
        }
        
        //Like button
        if(isset($_POST['like_button'])) {
            $this->total_likes++;
            PostsRepository::updateLikes($this->total_likes, $this->post_id);
            $total_user_likes++;
            UsersRepository::aggregateLikes($total_user_likes, $this->user_liked);
            LikesRepository::persistEntity(new LikesEntity(
                username: $userLoggedIn, 
                post_id: $this->post_id
            ));
        }
        //Unlike button
        if(isset($_POST['unlike_button'])) {
            $this->total_likes--;
            PostsRepository::updateLikes($this->total_likes, $this->post_id);
            $total_user_likes--;
            UsersRepository::aggregateLikes($total_user_likes, $this->user_liked);
            LikesRepository::dislike($userLoggedIn, $this->post_id);
        }
        //Check for previous likes by the currently-loggedin user.
        $num_rows = LikesRepository::getRowLikes($userLoggedIn, $this->post_id);

        $template = new Template(__DIR__ . '/../View');
        $html = $template->render('ConfirmPostView.php', [
            'num_rows' => $num_rows,
            'post_id' => $this->post_id,
            'total_likes' => $this->total_likes
        ]);

        return new Response(content: $html);
    }
}