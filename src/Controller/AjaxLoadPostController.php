<?php

namespace App\Controller;

use App\Controller\PostsController;

Class AjaxLoadPostController
{
    public function loadPostAjax() {
        $limit = 10; //Number of posts to be loaded per call
        $posts = new PostsController();
        $posts->loadPostsFriends($_REQUEST, $limit);
    }
}