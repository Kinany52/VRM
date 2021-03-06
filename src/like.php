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

//Get id of post
if(isset($_GET['post_id'])) {
	$post_id = $_GET['post_id'];
}

$get_likes = PDO::instance()->prepare("SELECT likes, added_by FROM posts WHERE id=?");
$get_likes->execute([$post_id]);
$row = $get_likes->fetch();
$total_likes = $row['likes']; 
$user_liked = $row['added_by'];

$user_details_query = PDO::instance()->prepare("SELECT * FROM users WHERE username=?");
$user_details_query->execute([$user_liked]);
$row = $user_details_query->fetch();
$total_user_likes = $row['num_likes'];

//Like button
if(isset($_POST['like_button'])) {
	$total_likes++;
	$query = PDO::instance()->prepare("UPDATE posts SET likes=? WHERE id=?");
	$query->execute([$total_likes, $post_id]);
	$total_user_likes++;
	$user_likes = PDO::instance()->prepare("UPDATE users SET num_likes=? WHERE username=?");
	$user_likes->execute([$total_user_likes, $user_liked]);
	$insert_user = PDO::instance()->prepare("INSERT INTO likes VALUES(?, ?, ?)");
	$insert_user->execute([NULL, $userLoggedIn, $post_id]);

	//Insert Notification
}
//Unlike button
if(isset($_POST['unlike_button'])) {
	$total_likes--;
	$query = PDO::instance()->prepare("UPDATE posts SET likes=? WHERE id=?");
	$query->execute([$total_likes, $post_id]);
	$total_user_likes--;
	$user_likes = PDO::instance()->prepare("UPDATE users SET num_likes=? WHERE username=?");
	$user_likes->execute([$total_user_likes, $user_liked]);
	$insert_user = PDO::instance()->prepare("DELETE FROM likes WHERE username=? AND post_id=?");
	$insert_user->execute([$userLoggedIn, $post_id]);
}

//Check for previous likes
$check_query = PDO::instance()->prepare("SELECT * FROM likes WHERE username=? AND post_id=?");
$check_query->execute([$userLoggedIn, $post_id]);
$fetch_check_query = $check_query->fetch();
$num_rows = $check_query->rowCount();

if($num_rows > 0) {
	echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
			<input type="submit" class="comment_like" name="unlike_button" value="Disconfirm">
			<div class="like_value">
				'. $total_likes .' Confirms
			</div>
		</form>
	';
}
else {
	echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
			<input type="submit" class="comment_like" name="like_button" value="Confirm">
			<div class="like_value">
				'. $total_likes .' Confirms
			</div>
		</form>
	';
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
		font-family: Arial, Helvetica, Sans-serif;
	}
	body {
		background-color: #fff;
	}

	form {
		position: absolute;
		top: 0;
	}
	</style>

</body>
</html>