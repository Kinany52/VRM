<?php

namespace App\Controller;

use App\Controller\LoadPostController;

Class AjaxLoadPostController
{
    public function loadPostAjax() {
        $limit = 10; //Number of posts to be loaded per call
        $posts = new LoadPostController();
        $posts->loadPost($_REQUEST, $limit);
    }
}