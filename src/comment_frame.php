<?php

use App\Att\User;
use App\Att\Post;
use App\Entity\PDO;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

bootstrap();

	if (isset($_SESSION['username'])) {
		$userLoggedIn = $_SESSION['username'];
		$user_details_query = PDO::instance()->prepare("SELECT * FROM users WHERE username=?");
		$user_details_query->execute([$userLoggedIn]);
		$user = $user_details_query->fetch();
	} 
	else {
		header("Location: register.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<style type="text/css">
	* {
		font-size: 12px;
		font-family: Arial, Helvetica, Sans-serif;
	}

	</style>

 	<script>
 		function toggle() {
 			var element = document.getElementById("comment_section");

 			if(element.style.display == "block")
 				element.style.display = "none";
 			else
 				element.style.display = "block";
 		}
 	</script>

 	<?php  
 	//Get id of post
 	if(isset($_GET['post_id'])) {
 		$post_id = $_GET['post_id'];
 	}

 	$user_query = PDO::instance()->prepare("SELECT added_by, user_to FROM posts WHERE id=?");
 	$user_query->execute([$post_id]);
 	$row = $user_query->fetch();

 	$posted_to = $row['added_by'];

 	if(isset($_POST['postComment' . $post_id])) {
 		$post_body = $_POST['post_body'];
 		$date_time_now = date("Y-m-d H:i:s");
 		$insert_post = PDO::instance()->prepare("INSERT INTO comments VALUES (?, ?, ?, ?, ?, ?, ?)");
 		$insert_post->execute([NULL, $post_body, $userLoggedIn, $posted_to, $date_time_now, 'no', $post_id]);
 			echo "<p>Comment Posted! </p>";
 	}
 	?>
 	<form action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
 		<textarea name="post_body"></textarea>
 		<input type="submit" name="postComment<?php echo $post_id; ?>" value="Post">	
 	</form>

 	<!-- Load comments -->


	<?php 
		$get_comments = PDO::instance()->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY id ASC");
		$get_comments->execute([$post_id]);
		$count = $get_comments->rowCount();
		
		if ($count !=0) {
			while($comment = $get_comments->fetch()) {
				$comment_body = $comment['post_body'];
				$posted_to = $comment['posted_to'];
				$posted_by = $comment['posted_by'];
				$date_added = $comment['date_added'];
				$removed = $comment['removed'];
				
				//Timeframe
				$date_time_now = date("Y-m-d H:i:s");
				$start_date = new DateTime($date_added);  //Time of post
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
				
				$user_obj = new User(PDO::instance(), $posted_by);


				?>
				<div class="comment_section">
					<a href="profile.php?profile_username=<?php echo $posted_by; ?>" target="_parent"> <b> <?php echo $user_obj->getFirstAndLastName(); ?></b></a>
					&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $time_message . "<br>" . $comment_body; ?>
					<hr>
				</div>
				<?php

			}
		}
		else {
			echo "<center><br><br>No Comment to Show!</center>";
		}

	?>
	 

</body>
</html>