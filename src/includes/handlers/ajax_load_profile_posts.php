<?php 
use App\DropShipper\User;
use App\Announce\Post;
 
include("../../../config/config.php");
include("../../Att/DropShipper/User.php");
include("../../Att/Announce/Post.php");

$limit = 10; //Number of posts to be loaded per call

$posts = new Post($con, $_REQUEST['userLoggedIn']);
$posts->loadProfilePosts($_REQUEST, $limit);
 ?>