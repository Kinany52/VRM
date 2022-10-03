<?php

namespace App\Controller;

use App\Entity\CommentsEntity;
use App\Repository\CommentsRepository;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use Core\Template;
use DateTime;

Class CommentController
{
    public function frameComment() {
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
        foreach (PostsRepository::getPoster($post_id) as $poster) 
        {
            $posted_to = $poster->added_by;
        }

        if(isset($_POST['postComment' . $post_id])) {
            $post_body = $_POST['post_body'];
            $date_time_now = new DateTime();
        CommentsRepository::persistEntity(new CommentsEntity(
            post_body: $post_body, 
            posted_by: $userLoggedIn, 
            posted_to: $posted_to, 
            date_added: $date_time_now, 
            post_id: $post_id,
            id: 0
        ));
            echo "<p>Comment Posted! </p>";
        }

        //Load comments

        $rowComments = CommentsRepository::getRowComments($post_id);
        
        if ($rowComments !=0) {
            foreach (CommentsRepository::getComments($post_id) as $loadComments) {
                $comment_body = $loadComments->post_body;
                $posted_to = $loadComments->posted_to;
                $posted_by = $loadComments->posted_by;
                $date_added = $loadComments->date_added;
                
                //Timeframe
                $date_time_now = date("Y-m-d H:i:s");
                $start_date = $date_added;  //Time of post
                $end_date = new DateTime($date_time_now); //Current time
                $interval = $start_date->diff($end_date); //Difference between dates
                if($interval->y >= 1) {
                    if($interval->y == 1)
                        $time_message = $interval->y . " year ago";  //1 year ago
                    else
                        $time_message = $interval->y . " years ago";  //1+ year ago
                }
                else if($interval->m >= 1) {
                    if($interval->d == 0){
                        $days = " ago";  
                    }
                    else if($interval->d == 1){
                        $days = $interval->d . " day ago";  //1 day ago
                    }
                    else{				
                        $days = $interval->d . " days ago";  // days ago
                    }
                
                    if($interval->m == 1){
                        $time_message = $interval->m . " month" . $days;  
                    }
                    else {
                        $time_message = $interval->m . " months" . $days;
                    }	
                }
                else if($interval->d >= 1){
                    if ($interval->d == 1) {
                        $time_message = $interval->d . " Yesterday";  //Yesterday
                    }
                    else{				
                        $time_message = $interval->d . " days ago";  // days ago
                    }
                }
                else if($interval->h >= 1){
                    if ($interval->h == 1) {
                        $time_message = $interval->h . " hour ago";  //hour ago
                    }
                    else{				
                        $time_message = $interval->h . " hours ago";  //hours ago
                    }
                }
                else if($interval->i >= 1){
                    if ($interval->i == 1) {
                        $time_message = $interval->i . " minute ago";  //minute ago
                    }
                    else{				
                        $time_message = $interval->i . " minutes ago";  //minutes ago
                    }
                }
                else {
                    if ($interval->s < 30) {
                        $time_message = " Just now";  //Just now
                    }
                    else{				
                        $time_message = $interval->s . " seconds ago";  //seconds ago
                    }
                }
                
                $userArray = UsersRepository::queryUser($posted_by);

                ?>
                <div class="comment_section">
                    <a href="profile?profile_username=<?php echo $posted_by; ?>" target="_parent"> <b> <?php echo $userArray['first_name'] . " " . $userArray['last_name']; ?></b></a>
                    &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $time_message . "<br>" . $comment_body; ?>
                    <hr>
                </div>
                <?php

            }
        }
        else {
            echo "<center><br><br>No Comment to Show!</center>";
        }

        $template = new Template('../src/View');
        echo $template->render('CommentView.php', [
            'post_id' => $post_id
        ]);
    }
}