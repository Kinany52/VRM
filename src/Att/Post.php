<?php

Namespace App\Att;

use App\Att\User;
use DateTime;
use App\Library\PDO;

class Post 
{
	private $user_obj;
	private $con;

	public function __construct($con, $user) {
		$this->con = PDO::instance();
		$this->user_obj = new User(PDO::instance(), $user);
	}

	public function submitPost($body) {
		$body = strip_tags($body); //removes html tags
		$body = str_replace('\r\n', '\n', $body); //Allows new line character
		$body = nl2br($body); //Replace new lines with line breaks

		$check_empty = preg_replace('/\s+/', '', $body); //Deletes all spaces

		if($check_empty != "") {


			//Current date and time
			$date_added = date("Y-m-d H:i:s");
			//Get username
			$added_by = $this->user_obj->getUsername();

			//Insert post
			$query = PDO::instance()->prepare("INSERT INTO posts VALUES(?, ?, ?, ?, ?, ?)");
			$query->execute([NULL, $body, $added_by, $date_added, 'no', '0']);
			$returned_id = PDO::instance()->lastInsertId();

			//Update post count for user
			$num_posts = $this->user_obj->getNumPosts();
			$num_posts++;
			$update_query = PDO::instance()->prepare("UPDATE users SET num_posts=? WHERE username=?");
			$update_query->execute([$num_posts, $added_by]);
		}
	}

	public function loadPostsFriends($data, $limit) {

		$page = $data['page'];
		$userLoggedIn = $this->user_obj->getUsername();

		if($page == 1)
			$start = 0;
		else
			$start = ($page - 1) * $limit;


		$str = ""; //String to return
		$data_query = PDO::instance()->prepare("SELECT * FROM posts WHERE deleted=? ORDER BY id DESC");
		$data_query->execute(['no']);
		//$fetch_data_query = $data_query->fetch();

		if($data_query->rowCount() > 0) {

			$num_iterations = 0; //Number of posts checked (Not necessarily posted)
			$count = 1;

			while ($row = $data_query->fetch()) {
				$id = $row['id'];
				$body = $row['body'];
				$added_by = $row['added_by'];
				$date_time = $row['date_added'];

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

				$user_details_query = PDO::instance()->prepare("SELECT first_name, last_name FROM users WHERE username=?");
				$user_details_query->execute([$added_by]);
				$user_row = $user_details_query->fetch();
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];

				?>
				<script>
					function toggle<?php echo $id; ?>() {

						var target = $(event.target);
						if (!target.is("a")) {
								var element = document.getElementById("toggleComment<?php echo $id; ?>");

					 			if(element.style.display == "block")
					 				element.style.display = "none";
					 			else
					 				element.style.display = "block";
						}

			 		}
				</script>
				<?php

				$comment_check = PDO::instance()->prepare("SELECT * FROM comments WHERE post_id=?");
				$comment_check->execute([$id]);
				$fetch_comment_check = $comment_check->fetch();
				$comment_check_num = $comment_check->rowCount();

				//Timeframe
				$date_time_now = date("Y-m-d H:i:s");
				$start_date = new DateTime($date_time); //Time of post
				$end_date = new DateTime($date_time_now); //Current time
				$interval = $start_date->diff($end_date); //Difference between dates
				if($interval->y >= 1) {
					if($interval == 1)
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
										<a href='profile.php?profile_username=$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
										$delete_button
									</div>
									<div id='post_body'>
											$body
											<br>
											<br>
											<br>
									</div>

									<div class='newsfeedPostOptions'>
											Comments($comment_check_num)&nbsp;&nbsp;&nbsp;
											<iframe src='like.php?post_id=$id' scrolling='no'></iframe>
									</div>
						</div>
						<div class='post_comment' id='toggleComment$id' style='display:none;'>
							<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
						</div>
						<hr>";

				?>
				<script>

					$(document).ready(function() {

						$('#post<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to delete this announcement?", function(result) {

								$.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {result:result});

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
	}

}

?>