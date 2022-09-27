<?php

namespace App\Controller;

use App\Controller\PostsController;
use App\Library\PDO;

Class AjaxLoadPostController
{
    public function loadPostAjax() {
        $limit = 10; //Number of posts to be loaded per call
        $posts = new PostsController(PDO::instance(), $_REQUEST['userLoggedIn']);
        $posts->loadPostsFriends($_REQUEST, $limit);
    }
}