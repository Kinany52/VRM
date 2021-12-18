<?php
use App\Vend\User;
use App\Announce\Post;
 
include("../../config/config.php");
include("../../App/Vend/User.php");
include("../../App/Announce/Post.php");

$limit = 10; //Number of posts to be loaded per call

$posts = new Post($con, $_REQUEST['userLoggedIn']);
$posts->loadPostsFriends($_REQUEST, $limit);
 ?>