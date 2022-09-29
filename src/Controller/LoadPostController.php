<?php

namespace App\Controller;

use DateTime;
use App\Repository\PostsRepository;
use App\Repository\CommentsRepository;
use App\Repository\UsersRepository;
use Core\Template;

class LoadPostController 
{
	public function loadPost($data, $limit) {

		$page = $data['page'];
		$userLoggedIn = $_SESSION['username'];
		
		if($page == 1)
			$start = 0;
		else
			$start = ($page - 1) * $limit;

		$str = ""; //String to return
		
		$rowPosts = PostsRepository::getRowPosts('no');
		
		if($rowPosts > 0) {
		
			$num_iterations = 0; //Number of posts checked (Not necessarily posted)
			$count = 1;

			foreach (PostsRepository::getPosts('no') as $loadAnnouncements) {
			
				$id = $loadAnnouncements->id;
				$body = $loadAnnouncements->body;
				$date_time = $loadAnnouncements->date_added;
				$added_by = $loadAnnouncements->added_by;

				if($num_iterations++ < $start)
					continue;
				
				//Once 10 posts have been loaded, break
				if($count > $limit) {
					break;
				}
				else {
					$count++;
				}

				if($userLoggedIn == $added_by)

					$delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
				else
					$delete_button = "";

				$user_details_query = UsersRepository::authenticateFullname($added_by);
				$first_name = $user_details_query['first_name'];
				$last_name = $user_details_query['last_name'];

				//Check number of comments on each post.
				$numComments = CommentsRepository::getRowComments($id);
				//Timeframe
				$date_time_now = date("Y-m-d H:i:s");
				$start_date = $date_time; //Time of post
				$end_date = new DateTime($date_time_now); //Current time
				$interval = $start_date->diff($end_date); //Difference between dates
				if($interval->y >= 1) {
					if($interval == true) 
						$time_message = $interval->y . " year ago"; //1 year ago
					else
						$time_message = $interval->y . " years ago"; //1+ year ago
				}
				else if($interval-> m >= 1) {
					if($interval->d == 0) {
						$days = " ago";
					}
					else if($interval->d == 1) {
						$days = $interval->d . " day ago";
					}
					else {
						$days = $interval->d . " days ago";
					}


					if($interval->m == 1) {
						$time_message = $interval->m . " month". $days;
					}
					else {
						$time_message = $interval->m . " months". $days;
					}
				}
				else if($interval->d >= 1) {
					if($interval->d == 1) {
						$time_message = "Yesterday";
					}
					else {
						$time_message = $interval->d . " days ago";
					}
				}
				else if($interval->h >= 1) {
					if($interval->h == 1) {
						$time_message = $interval->h . " hour ago";
					}
					else {
						$time_message = $interval->h . " hours ago";
					}
				}
				else if($interval->i >= 1) {
					if($interval->i == 1) {
						$time_message = $interval->i . " minute ago";
					}
					else {
						$time_message = $interval->i . " minutes ago";
					}
				}
				else {
					if($interval->s < 30) {
						$time_message = "Just now";
					}
					else {
						$time_message = $interval->s . " seconds ago";
					}
				}
				
				$str .="<div class='status_post' onClick='javascrpt:toggle$id()'>
							<div class='posted_by' style='color:#ACACAC;'>
								<a href='profile?profile_username=$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
								$delete_button
							</div>
							<div id='post_body'>
									$body
									<br>
									<br>
									<br>
							</div>
							<div class='newsfeedPostOptions'>
									Comments($numComments)&nbsp;&nbsp;&nbsp;
									<iframe src='/confirm_post?post_id=$id' scrolling='no'></iframe>
							</div>
						</div>
						<div class='post_comment' id='toggleComment$id' style='display:none;'>
							<iframe src='/comment_frame?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
						</div>
						<hr>";
				
				?>
				<script>
					$(document).ready(function() {
						$('#post<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to delete this announcement?", function(result) {

								$.post("<?php echo '/delete_post?post_id=' . $id; ?>", {result:result});

								if(result)
									location.reload();

							});
						});
					});
				</script>
				<?php
				
			}	//End while loop 

			if($count > $limit)
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
			else
				$str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more announcements to show! </p>";
		}	
		echo $str;
		
		$template = new Template('../src/View');
        echo $template->render('LoadPostView.php', [
            'id' => $id,
        ]);
		
	}
}